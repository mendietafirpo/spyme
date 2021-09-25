<?php

namespace App\Http\Controllers;
use App\Models\Firma;
use App\Models\App;
use App\Models\Dffjur;
use App\Models\Dfafip;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FirmaController extends Controller
{

    public function mysmes(Request $request)
    {
        /* PARA USUARIOS */

        if (!session('idRole')){
        foreach (Auth::user()->roles as $role) {
            $idRole = $role->id;
        }
        session()->put('idRole',$idRole);
        }

        $cuit  = $request->get('cuit');
        $rSocial = $request->get('razonSocial');
        $ciudad = $request->get('ciudad');
        $sql= $request->get('sql');

        /** COLABORADORES Y USUARIOS */
        /**tramite banco */
        if($sql==1){

            $firmas = DB::table('firma_proyecto')
            ->where('programa',1)
            ->join('tramites','firma_proyecto.proyecto_idProy','=','tramites.idProy')
            ->join('firmas','firma_proyecto.firma_idFirma','=','idFirma')
            ->where('consultaAgenteFinan','>',Carbon::today()->subDays(240))
            ->where('informeSujetoCredito','=',null)
            ->where('fechaDesistido','=',null)
            ->where('fechaDadoDeBaja','=',null)
            ->select('idFirma','cuit','razonSocial','ciudad')
            ->Paginate( 20,['idFirma','cuit','razonSocial','ciudad']);

            session()->flash('info', 'Lista de proyectos en trámite banco');

                return view('pymes.mysmes', compact('firmas'))
                ->with('i', (request()->input('page', 1) - 1) * 20);
        }
        /**tramite uep */
        elseif($sql==2){

            $firmas = DB::table('firma_proyecto')
            ->where('programa',1)
            ->join('tramites','firma_proyecto.proyecto_idProy','=','tramites.idProy')
            ->join('firmas','firma_proyecto.firma_idFirma','=','idFirma')
            ->where('informeSujetoCredito','>',Carbon::today()->subDays(180))
            ->where('sujetoCredito','=','Favorable')
            ->where('remisionOrganismo','=',null)
            ->where('fechaDesistido','=',null)
            ->where('fechaDadoDeBaja','=',null)
            ->select('idFirma','cuit','razonSocial','ciudad')
            ->Paginate( 20,['idFirma','cuit','razonSocial','ciudad']);
            session()->flash('info', 'Lista de proyectos en trámite uep');

            return view('pymes.mysmes', compact('firmas'))
            ->with('i', (request()->input('page', 1) - 1) * 20);

        }
        /**tramite cfi */
        elseif($sql==3){

            $firmas = DB::table('firma_proyecto')
            ->where('programa',1)
            ->join('tramites','firma_proyecto.proyecto_idProy','=','tramites.idProy')
            ->join('firmas','firma_proyecto.firma_idFirma','=','idFirma')
            ->where('remisionOrganismo','>',Carbon::today()->subDays(180))
            ->where('resolucionElegibilidad','=',null)
            ->where('fechaDesistido','=',null)
            ->where('fechaDadoDeBaja','=',null)
            ->select('idFirma','cuit','razonSocial','ciudad')
            ->Paginate(20,['idFirma','cuit','razonSocial','ciudad']);
            session()->flash('info', 'Lista de proyectos en trámite cfi');
            return view('pymes.mysmes', compact('firmas'))
            ->with('i', (request()->input('page', 1) - 1) * 20);

        }
        /**tramite cobro */
        elseif($sql==4){

            $firmas = DB::table('firma_proyecto')
            ->where('programa',1)
            ->join('tramites','firma_proyecto.proyecto_idProy','=','tramites.idProy')
            ->join('firmas','firma_proyecto.firma_idFirma','=','idFirma')
            ->where('resolucionElegibilidad','>',Carbon::today()->subDays(180))
            ->where('efectivizacion','=',null)
            ->where('fechaDesistido','=',null)
            ->where('fechaDadoDeBaja','=',null)
            ->select('idFirma','cuit','razonSocial','ciudad')
            ->Paginate( 20,['idFirma','cuit','razonSocial','ciudad']);


            session()->flash('info', 'Lista de proyectos en trámite de cobro');
            return view('pymes.mysmes', compact('firmas'))
            ->with('i', (request()->input('page', 1) - 1) * 20);
        }
        /**efectivizados - ultimos año */
        elseif($sql==5){

            $firmas = DB::table('firma_proyecto')
            ->where('programa',1)
            ->join('tramites','firma_proyecto.proyecto_idProy','=','tramites.idProy')
            ->join('firmas','firma_proyecto.firma_idFirma','=','idFirma')
            ->where('efectivizacion','>',Carbon::today()->subDays(360))
            ->select('idFirma','cuit','razonSocial','ciudad')
            ->Paginate( 20,['idFirma','cuit','razonSocial','ciudad']);

            $sql = DB::table('firma_proyecto')
            ->where('programa',1)
            ->join('tramites','firma_proyecto.proyecto_idProy','=','tramites.idProy')
            ->where('efectivizacion','>',Carbon::today()->subDays(360))
            ->join('proyectos','firma_proyecto.proyecto_idProy','=','proyectos.idProy');

            $dolares = $sql->where('moneda',1)->sum('montoTotal');
            $pesos = $sql->where('moneda',2)->sum('montoTotal');


            echo "pesos = ".$pesos." dólares = ".$dolares;
            /*
            $tot =$totales->sum('montoTotal');
            $cant =$totales->count('montoTotal');

            session()->flash('info', 'Proyectos efectivizados último año ('.$cant.' por $ '.number_format($tot, 0, ',', '.').')');
            return view('pymes.mysmes', compact('firmas'))
            ->with('i', (request()->input('page', 1) - 1) * 20);*/
        }

            /**efectivizados - ultimo años  */
            elseif($sql==6){

                $firmas = DB::table('firma_proyecto')
                ->where('programa',1)
                ->join('tramites','firma_proyecto.proyecto_idProy','=','tramites.idProy')
                ->join('firmas','firma_proyecto.firma_idFirma','=','idFirma')
                ->where('efectivizacion','>',Carbon::today()->subDays(720))
                ->select('idFirma','cuit','razonSocial','ciudad')
                ->Paginate( 20,['idFirma','cuit','razonSocial','ciudad']);


                session()->flash('info', 'Lista de proyectos en trámite de cobro');
                return view('pymes.mysmes', compact('firmas'))
                ->with('i', (request()->input('page', 1) - 1) * 20);
        }

        else{
            session()->flash('info', '');
            if ((session('idRole'))>=1 && (session('idRole'))<=3){

                $firmas = DB::table('firma_proyecto')
                ->where('programa',1)
                ->join('firmas','firma_proyecto.firma_idFirma','=','idFirma')
                ->where('cuit','like','%'.$cuit.'%')
                ->where('ciudad','like','%'.$ciudad.'%')
                ->where('razonSocial','like','%'.$rSocial.'%')
                ->select('idFirma','cuit','razonSocial','ciudad')
                ->Paginate( 20,['idFirma','cuit','razonSocial','ciudad']);

                return view('pymes.mysmes', compact('firmas'))
                ->with('i', (request()->input('page', 1) - 1) * 20);
            }
            else {

                return back()
            ->with('info','error en la carga de la lista');
            }

        }
    }


}
