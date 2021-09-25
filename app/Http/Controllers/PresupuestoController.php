<?php

namespace App\Http\Controllers;

use App\Models\Presupuesto;
use App\Models\Dfrubinv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Error;


class PresupuestoController extends Controller
{


/* OPERACION USUARIOS */

    public function irpresup($id)
    {
        session()->put('idProy', $id);
        $dfrubinv = Dfrubinv::pluck('descripcion','id')->unique();
        $presupuestos = Presupuesto::where('idProy', $id)->get();

        if(isset($presupuestos)){
            return view('presupuestos.index', compact('presupuestos','dfrubinv'));
        }
        else{
            return redirect()->route('presupuestos.create');

        }
    }

    public function create()
    {

        $dfrubinv = Dfrubinv::pluck('descripcion','id')->unique();

        $idProy = session('idProy');
        $idLast= Presupuesto::max('id') + 1;

        return view('presupuestos.create', compact('idLast','idProy','dfrubinv'));
    }

        public function store(Request $request)
    {

            $idProy = session('idProy');
            $presupuesto = Presupuesto::create($request->all());
            $presupuesto->save();
            /**item */
            $rubro =$request->input('rubroAplFon');
            $id =$request->input('id');
            session()->put('rubro', $rubro);
            session()->put('id', $id);
            $item = Presupuesto::where('idProy','=', $idProy)
            ->Where(function ($query) {
                $query->where('rubroAplFon','=',session('rubro'))
                      ->where('id','<>',session('id'));
            })
            ->max('item') + 1;
            $presupuesto = Presupuesto::findOrFail(session('id'));
            $presupuesto->item = $item;
            $presupuesto->save();

            return redirect('/presupuestos/index/'.$idProy)
                ->with('success','Se agregó el presupuesto correctamente.');
    }

    public function edit($id)
    {

        $dfrubinv = Dfrubinv::pluck('descripcion','id')->unique();
        $presupuesto = Presupuesto::where('id', $id)->first();

        return view('presupuestos.edit',compact('presupuesto','dfrubinv'));

    }


    public function update(Request $request,$id)
    {
        $presupuesto = Presupuesto::where('id', $id)->first();

        $presupuesto->update($request->all());

            return redirect('/presupuestos/index/'.session('idProy'))
            ->with('success','Se modificó el presupuesto correctamente');
    }

    public function destroy(Presupuesto $presupuesto)
    {

        $presupuesto->delete();
        return redirect('/presupuestos/index/'.session('idProy'))
        ->with('success','Se eliminó el presupuesto correctamente');

    }

}
