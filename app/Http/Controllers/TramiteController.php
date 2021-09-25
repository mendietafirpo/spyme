<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Firma;
use App\Models\User;
use App\Models\Proyecto;
use App\Models\Tramite;
use App\Models\Dfmoney;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Error;


class TramiteController extends Controller
{


/* OPERACION USUARIOS */

    public function irtramite($id)
    {
        session()->put('idProy', $id);

        $tramite = Tramite::where('idProy', $id)->first();

        if(isset($tramite)){

            return view('tramites.show', compact('tramite'));
        }
        else{

            return redirect()->route('tramites.create');

        }
    }

    public function create()
    {
        $idProy = session('idProy');
        $idLast= Tramite::max('id') + 1;

        return view('tramites.create', compact('idLast','idProy'));
    }

        public function store(Request $request)
    {
            $tramite = Tramite::create($request->all());
            $tramite->save();

                return redirect('/tramites.show/'.$request->input('idProy'))
                ->with('success','Se agregó el tramite correctamente.');
    }

    public function edit($id)
    {
        $tramite = Tramite::where('idProy', $id)->first();

        return view('tramites.edit',compact('tramite'));

    }


    public function update(Request $request,$id)
    {
        $tramite = Tramite::where('idProy', $id)->first();

        $tramite->update($request->all());

            return redirect('/tramites.show/'.$id)
            ->with('success','Se modificó el tramite correctamente');
    }

    public function destroy(Tramite $tramite)
    {

        $tramite->delete();
        return redirect('/tramite/show/')
        ->with('success','Se eliminó el tramite correctamente');

    }

}
