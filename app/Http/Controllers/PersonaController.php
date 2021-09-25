<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Firma;
use App\Models\User;
use App\Models\Dfecurs;
use App\Models\Dfeciv;
use App\Models\Firmapersonarel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Error;


class PersonaController extends Controller
{


/* OPERACION USUARIOS */

    public function irpersona($id,Request $request)
    {
        session()->put('idFirma', $id);

        $firma=Firma::find($id);
        foreach ($firma->personas as $persona) {
          $idPers = $persona->idPers;
        }

        /** si existe relación voy a index ->idPers */


        if(isset($idPers)){
            $fprel = Firmapersonarel::pluck('descripcion','id');
            $persona = Persona::whereHas('firmas',function($query) {
                $query->where('idFirma', '=', session('idFirma'));
            })
            ->get();

            return view('personas.socio', compact('personas','fprel'));
        }
        else{

            return redirect()->route('personas.create');

        }
    }
/* ADMINISTRADORES */
     public function index(Request $request)
    {
        $documento  = $request->get('documentoIdentidad');
        $apellido = $request->get('apellidoNombres');
        $ciudad = $request->get('ciudad');
        $fprel = Firmapersonarel::pluck('descripcion','id');
        $personas = Persona::orderBy('idPers', 'DESC')
        ->documento($documento)
        ->ciudad($ciudad)
        ->apellido($apellido)
        ->Paginate(20);

        return view('personas.index', compact('personas','fprel'))
        ->with('i', (request()->input('page', 1) - 1) * 20);
    }

    public function create()
    {
        $cities = Persona::orderBy('ciudad')->pluck('ciudad')->unique();
        $districts = Persona::orderBy('distrito')->pluck('distrito')->unique();
        $states = Persona::orderBy('estado')->pluck('estado')->unique();
        $countries = Persona::orderBy('pais')->pluck('pais')->unique();
        $personas = Firma::pluck('idFirma');
        $dfecurs = Dfecurs::pluck('descripcion','id');
        $dfeciv = Dfeciv::pluck('descripcion','id');
        $fprel = Firmapersonarel::pluck('descripcion','id');
        $idLast= Persona::max('idPers') + 1;

        return view('personas.create', compact('personas','dfecurs','dfeciv','fprel','idLast','cities','districts','states','countries'));
    }

        public function store(Request $request)
    {
        $request->validate([
            'documentoIdentidad' => 'required|min:8|max:9',
            'nombresApellido' => 'required|min:5',
            'ciudad' => 'required',
            'email' => 'required|email',
        ]);
        $documentoIdentidad  = $request->input('documentoIdentidad');
        if (Persona::where('documentoIdentidad', $documentoIdentidad)->first()){
            if (session('idRole')>=1 && session('idRole')<=2){
            return redirect()->route('personas.index', array('documentoIdentidad' => $documentoIdentidad))
            ->with('success','el documentoIdentidad '.$documentoIdentidad.' ya existe:');
            }
            elseif(session('idRole')>=3)
            {
                return redirect()->action([PersonaController::class, 'irpersona'],['documentoIdentidad' => $documentoIdentidad])
                ->with('success','el documentoIdentidad '.$documentoIdentidad.' ya existe:');
            }
        }
        else
        {
            $id_f = session('idFirma');
            $personas = Persona::create($request->all());
            $personas->save();
            $personas=Persona::find($request->input('idPers'));
            $personas->firmas()->attach($id_f,['tipoRelacion'=>$request->input('tipoRelacion')]);


            if (session('idRole')>=1 && session('idRole')<=2){

                return redirect('/firmas/'.$id_f)
                ->with('success','Se agregó la Persona documentoIdentidad ('.$documentoIdentidad.') correctamente.');
            }
                elseif(session('idRole')>=3){
                    return redirect('/pymes/mysmes/')
                    ->with('success','Se agregó la Persona documentoIdentidad ('.$documentoIdentidad.') correctamente.');
            }
        }
    }

    /* OPERACIONES COMUNES */

    public function show($id)
    {
        $fprel = Firmapersonarel::pluck('descripcion','id');
        $dfecurs = Dfecurs::pluck('descripcion','id');
        $dfeciv = Dfeciv::pluck('descripcion','id');
        $persona = Persona::find($id);

        return view('personas.show', compact('persona','dfecurs','dfeciv','fprel'));
    }

    public function edit($id)
    {
        $fprel = Firmapersonarel::pluck('descripcion','id');
        $persona = Persona::find($id);
        $dfecurs = Dfecurs::pluck('descripcion','id');
        $dfeciv = Dfeciv::pluck('descripcion','id');
        $cities = Persona::orderBy('ciudad')->pluck('ciudad')->unique();
        $districts = Persona::orderBy('distrito')->pluck('distrito')->unique();
        $states = Persona::orderBy('estado')->pluck('estado')->unique();
        $countries = Persona::orderBy('pais')->pluck('pais')->unique();

            return view('personas.edit',compact('persona','dfecurs','dfeciv','fprel','cities','districts','states','countries'));

    }


    public function update(Request $request,$id)
    {
        $request->validate([
            'documentoIdentidad' => 'required|min:8|max:10',
            'nombresApellido' => 'required|min:5',
            'ciudad' => 'required',
            'email' => 'required|email',
        ]);
        $persona = Persona::find($id);

        foreach ($persona->firmas as $firma) {
            $idFirma = $firma->idFirma;
          }

        $persona->update($request->all());
        $persona->firmas()->updateExistingPivot($idFirma,['tipoRelacion' => $request->input('tipoRelacion')]);

            return redirect('/personas/socio/'.$idFirma)
                  ->with('success','Se modificó la Persona correctamente');
    }

    public function destroy(Persona $persona)
    {
        foreach ($persona->firmas as $firma) {
            $idFirma = $firma->idFirma;
          }

        $persona->delete();
        return redirect('/personas/socio/'.$idFirma)
        ->with('success','Se eliminó la firma correctamente');

    }

}
