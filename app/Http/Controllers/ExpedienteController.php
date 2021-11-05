<?php

namespace App\Http\Controllers;

use App\Models\Expediente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Error;


class ExpedienteController extends Controller
{


/* OPERACION USUARIOS */

    public function irexpte($id)
    {
        session()->put('idProy', $id);

        $go=-1;
        $expediente = Expediente::where('idProy', $id)->first();

        if(isset($expediente)){

            return view('expedientes.show', compact('expediente','go'));
        }
        else{

            return redirect()->route('expedientes.create');

        }
    }

    public function cargaexpte(Request $request){
        $idProy = $request->input('idProy');
        if ($idProy){

            $expte = Expediente::create($request->all());
            $expte->save();


            return redirect()->route('pymes.cargatramite');

        }else {
            $operatoria = Expediente::orderBy('operatoriaPrograma')->pluck('operatoriaPrograma')->unique();
            $banco = Expediente::orderBy('agenteFinanciero')->pluck('agenteFinanciero')->unique();
            $sucursal = Expediente::orderBy('sucursalVentanilla')->pluck('sucursalVentanilla')->unique();
            $tecnico = Expediente::orderBy('evaluadorTecnico')->pluck('evaluadorTecnico')->unique();
            $fuenteFds = Expediente::orderBy('entidadFuenteDeFondos')->pluck('entidadFuenteDeFondos')->unique();

            $idProy = session('idProy');
            $idLast= Expediente::max('id') + 1;

            return view('pymes.cargaexpte', compact('idLast','idProy','operatoria','banco','sucursal','tecnico','fuenteFds'));
        }

    }


    public function create()
    {
        $operatoria = Expediente::orderBy('operatoriaPrograma')->pluck('operatoriaPrograma')->unique();
        $banco = Expediente::orderBy('agenteFinanciero')->pluck('agenteFinanciero')->unique();
        $sucursal = Expediente::orderBy('sucursalVentanilla')->pluck('sucursalVentanilla')->unique();
        $tecnico = Expediente::orderBy('evaluadorTecnico')->pluck('evaluadorTecnico')->unique();

        $idProy = session('idProy');
        $idLast= Expediente::max('id') + 1;

        return view('expedientes.create', compact('idLast','idProy','operatoria','banco','sucursal','tecnico'));
    }

        public function store(Request $request)
    {
            $expediente = Expediente::create($request->all());
            $expediente->save();

            $go=-4;
            return view('expedientes.show', compact('expediente','go'))
            ->with('success','Se agregó el expediente correctamente.');
    }

    public function edit($id)
    {

        $operatoria = Expediente::orderBy('operatoriaPrograma')->pluck('operatoriaPrograma')->unique();
        $banco = Expediente::orderBy('agenteFinanciero')->pluck('agenteFinanciero')->unique();
        $sucursal = Expediente::orderBy('sucursalVentanilla')->pluck('sucursalVentanilla')->unique();
        $tecnico = Expediente::orderBy('evaluadorTecnico')->pluck('evaluadorTecnico')->unique();
        $expediente = Expediente::where('idProy', $id)->first();

        return view('expedientes.edit',compact('expediente','operatoria','banco','sucursal','tecnico'));

    }


    public function update(Request $request,$id)
    {
        $expediente = Expediente::where('idProy', $id)->first();

        $expediente->update($request->all());

        $go=-3;
        return view('expedientes.show', compact('expediente','go'))
        ->with('success','Se modificó el expediente correctamente');
    }

    public function destroy(Expediente $expediente)
    {

        $expediente->delete();
        return redirect('/expedientes/show/')
        ->with('success','Se eliminó el expediente correctamente');

    }

}
