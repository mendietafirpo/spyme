<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\Dfrubinv;
use App\Models\DfEntidadRubro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Error;


class BalanceController extends Controller
{


/* OPERACION USUARIOS */

    public function irmb($id)
    {
        session()->put('idFirma', $id);
        $dfentrubro = DfEntidadRubro::pluck('descripcion','id')->unique();
        $dfrubinv = Dfrubinv::pluck('descripcion','id')->unique();
        $balances = Balance::where('idFirma', $id)->get();

        if(isset($balances)){

            return view('balances.index', compact('balances','dfentrubro','dfrubinv'));
        }
        else{

            return redirect()->route('balances.create');

        }
    }

    public function create()
    {

        $dfentrubro = DfEntidadRubro::pluck('descripcion','id')->unique();
        $dfrubinv = Dfrubinv::pluck('descripcion','id')->unique();

        $idFirma = session('idFirma');
        $idLast= Balance::max('id') + 1;

        return view('balances.create', compact('idLast','idFirma','dfentrubro','dfrubinv'));
    }

        public function store(Request $request)
    {

            $idFirma = session('idFirma');
            $balance = Balance::create($request->all());
            $balance->save();
            /**item */
            $rubro =$request->input('rubro');
            $id =$request->input('id');
            session()->put('rubro', $rubro);
            session()->put('id', $id);
            $item = Balance::where('idFirma','=', $idFirma)
            ->Where(function ($query) {
                $query->where('rubro','=',session('rubro'))
                      ->where('id','<>',session('id'));
            })
            ->max('item') + 1;
            $balance = Balance::findOrFail(session('id'));
            $balance->item = $item;
            $balance->save();

            return redirect('/balances/index/'.$idFirma)
                ->with('success','Se agregó el balance correctamente.');
    }

    public function edit($id)
    {

        $dfentrubro = DfEntidadRubro::pluck('descripcion','id')->unique();
        $dfrubinv = Dfrubinv::pluck('descripcion','id')->unique();
        $balance = Balance::where('id', $id)->first();

        return view('balances.edit',compact('balance','dfentrubro','dfrubinv'));

    }


    public function update(Request $request,$id)
    {
        $balance = Balance::where('id', $id)->first();

        $balance->update($request->all());

            return redirect('/balances/index/'.session('idFirma'))
            ->with('success','Se modificó el balance correctamente');
    }

    public function destroy(Balance $balance)
    {

        $balance->delete();
        return redirect('/balances/index/'.session('idFirma'))
        ->with('success','Se eliminó el balance correctamente');

    }

}
