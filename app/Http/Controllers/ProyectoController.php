<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Firma;
use App\Models\User;
use App\Models\Proyecto;
use App\Models\Dfmoney;
use App\Models\Dfciiu;
use App\Models\Dfciiu2;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Error;


class ProyectoController extends Controller
{


/* OPERACION USUARIOS */

    public function irproyecto($id, Request $request)
    {
        session()->put('idFirma', $id);


        /*$proyectos = Proyecto::whereHas('firmas',function($query) {
            $query->where('idFirma', '=', session('idFirma'));
        })
        ->get();*/
        $go=-1;
        $proyectos = DB::table('firma_proyecto')
        ->where('programa',1)
        ->where('firma_idFirma', '=', $id)
        ->join('proyectos','proyecto_idProy','=','idProy')
        ->get();


        /** si existe relación voy a index ->idPers */

        if(isset($proyectos)){

            return view('proyectos.proyecto', compact('proyectos','go'));
        }
        else{

            return redirect()->route('proyectos.create');

        }
    }
/* ADMINISTRADORES */
     public function index(Request $request)
    {
        $go=-1;
        $nombreProyecto  = $request->get('nombreProyecto');
        $destinoFondos = $request->get('destinoFondos');
        $montoTotal = $request->get('montoTotal');
        $proyectos = Proyecto::orderBy('idProy', 'DESC')
        ->nombreproyecto($nombreProyecto)
        ->destinofondos($destinoFondos)
        ->montototal($montoTotal)
        ->Paginate(20);

        return view('proyectos.proyecto', compact('proyectos','go'))
        ->with('i', (request()->input('page', 1) - 1) * 20);
    }

    public function cargaproyecto(Request $request)
    {
        $idProy = $request->input('idProy');
        if ($idProy){

            $proyectos = Proyecto::create($request->all());
            $proyectos->save();
            $id_f = session('idFirma');
            $proyectos=Proyecto::find($idProy);
            $proyectos->firmas()->attach($id_f,['programa'=>1]);

            // cargar resto ciiu
            $ciiuCs =$request->input('ciiuCs');
            if (isset($ciiuCs) && $ciiuCs){
                $ciiuG = substr($ciiuCs, 0, 3);
                $proyectos = Proyecto::findOrFail($idProy)->update([
                    'ciiuCt' => Dfciiu2::where('grupo',$ciiuG)->pluck('categ')->unique()->first(),
                    'ciiuG' => $ciiuG,
                ]);
            }
            session()->put('idProy',$idProy);
            return redirect()->route('pymes.cargaexpte');

        }else {
            $dfmoney = Dfmoney::pluck('descripcion','id');
            $dfciiu = Dfciiu::pluck('descripcion','ciiuCs');
            $proyectos = Firma::pluck('idFirma');
            $gtias = Proyecto::orderBy('garantiasOfrecidas')->pluck('garantiasOfrecidas')->unique();
            $idLast= Proyecto::max('idProy') + 1;

            return view('pymes.cargaproyecto', compact('proyectos','idLast','dfmoney','dfciiu','gtias'));
        }
    }

    public function ciiusearch(Request $request){
        $ciiu = $request->get('ciiu');
        if ($ciiu){
            $dfciiu = Dfciiu::where('descripcion','LIKE','%'. $ciiu .'%')->pluck('descripcion','ciiuCs');
        }else{
            $dfciiu = Dfciiu::pluck('descripcion','ciiuCs');
        }
        return view('pymes.ciiusearch', compact('dfciiu'));
    }

    public function create()
    {
        foreach (Auth::user()->roles as $role) {
            $idRole = $role->id;
        }
        session()->put('idRole', $idRole);

        $dfmoney = Dfmoney::pluck('descripcion','id');
        $dfciiu = Dfciiu::pluck('descripcion','ciiuCs');
        $proyectos = Firma::pluck('idFirma');
        $idLast= Proyecto::max('idProy') + 1;

        return view('proyectos.create', compact('proyectos','idLast','dfmoney','dfciiu'));
    }

        public function store(Request $request)
    {
        $request->validate([
            'nombreProyecto' => 'required|min:5',
            'destinoFondos' => 'required|min:5',
            'montoTotal' => 'required|numeric',
            'inversionTotal' => 'required',
        ]);
            $id_f = session('idFirma');
            $proyectos = Proyecto::create($request->all());
            $proyectos->save();
            $proyectos=Proyecto::find($request->input('idProy'));
            $proyectos->firmas()->attach($id_f,['programa'=>1]);
            $idProy = $request->input('idProy');
            $ciiuCs =$request->input('ciiuCs');
            if (isset($ciiuCs) && $ciiuCs){
                $ciiuG = substr($ciiuCs, 0, 3);
                $proyectos = Proyecto::findOrFail($idProy)->update([
                    'ciiuCt' => Dfciiu2::where('grupo',$ciiuG)->pluck('categ')->unique()->first(),
                    'ciiuG' => $ciiuG,
                ]);
            }
            $go=-4;
            $proyectos = Proyecto::orderBy('idProy', 'DESC');
            if (session('idRole')>=1 && session('idRole')<=3){

                return redirect('/proyectos/proyecto/'.session('idFirma'))
                 ->with('success','Se agregó el proyecto correctamente.');
            }
    }

    /* OPERACIONES COMUNES */

    public function show($id)
    {
        $dfmoney = Dfmoney::pluck('descripcion','id');
        $proyecto = Proyecto::find($id);

        return view('proyectos.show', compact('proyecto','dfmoney'));
    }

    public function edit($id)
    {
        $dfmoney = Dfmoney::pluck('descripcion','id');
        $dfciiu = Dfciiu::pluck('descripcion','ciiuCs');
        $proyecto = Proyecto::find($id);

            return view('proyectos.edit',compact('proyecto','dfmoney','dfciiu'));

    }


    public function update(Request $request,$id)
    {
        $request->validate([
            'nombreProyecto' => 'required|min:5',
            'destinoFondos' => 'required|min:5',
            'montoTotal' => 'required',
            'inversionTotal' => 'required',
        ]);
        $proyectos = Proyecto::find($id);

        foreach ($proyectos->firmas as $firma) {
            $idFirma = $firma->idFirma;
          }

        $proyectos->update($request->all());
        $proyectos->firmas()->updateExistingPivot($idFirma,['programa' => 1]);

        //cargar ciiu
        $idProy = $request->input('idProy');
        $ciiuCs = $request->input('ciiuCs');
        if (isset($ciiuCs) && $ciiuCs){
            $ciiuG = substr($ciiuCs, 0, 3);
            $proyectos = Proyecto::findOrFail($idProy)->update([
                'ciiuCt' => Dfciiu2::where('grupo',$ciiuG)->pluck('categ')->unique()->first(),
                'ciiuG' => $ciiuG,
            ]);
        }


        $go=-4;
        $proyectos = DB::table('firma_proyecto')
        ->where('firma_idFirma', '=', session('idFirma'))
        ->join('proyectos','proyecto_idProy','=','idProy')
        ->get();

        return view('proyectos.proyecto', compact('proyectos','go'))
            ->with('success','Se modificó el proyecto correctamente');
    }

    public function destroy(Proyecto $proyecto)
    {
        foreach ($proyecto->firmas as $firma) {
            $idFirma = $firma->idFirma;
          }

        $proyecto->delete();
        return redirect('/proyectos/proyecto/'.$idFirma)
        ->with('success','Se eliminó el proyecto correctamente');

    }

}
