<?php

namespace App\Http\Controllers;

use App\Models\Gestion;
use App\Models\Dfrubinv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Error;


class GestionController extends Controller
{


/* OPERACION USUARIOS */

    public function irgestion($id)
    {
        session()->put('idProy', $id);
        $procesos = Gestion::pluck('proceso')->unique();
        $gestiones = Gestion::where('idProy', $id)->get();

        if(isset($gestiones)){

            return view('gestiones.index', compact('gestiones','procesos'));
        }
        else{

            return redirect()->route('gestiones.create');

        }
    }

    public function create()
    {

        $procesos = Gestion::pluck('proceso')->unique();
        $idProy = session('idProy');
        $idLast= Gestion::max('id') + 1;

        return view('gestiones.create', compact('idLast','idProy','procesos'));
    }

        public function store(Request $request)
    {
            $idProy = session('idProy');
            $gestion = Gestion::create($request->all());
            $gestion->save();

            return redirect('/gestiones/index/'.$idProy)
                ->with('success','Se agregó el gestion correctamente.');
    }

    public function edit($id)
    {

        $procesos = Gestion::pluck('proceso')->unique();
        $gestion = Gestion::where('id', $id)->first();

        return view('gestiones.edit',compact('gestion','procesos'));

    }


    public function update(Request $request,$id)
    {
        $gestion = Gestion::where('id', $id)->first();

        $gestion->update($request->all());

            return redirect('/gestiones/index/'.session('idProy'))
            ->with('success','Se modificó el gestion correctamente');
    }

    public function destroy($id)
    {

          // $gestion->delete();
          $gestiones = Gestion::findOrFail($id);
          $gestiones -> delete();

        return redirect('/gestiones/index/'.session('idProy'))
        ->with('success','Se eliminó el presupuesto correctamente');
    }

}
