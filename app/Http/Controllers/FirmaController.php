<?php

namespace App\Http\Controllers;
use App\Models\Firma;
use App\Models\Tramite;
use App\Models\Expediente;
use App\Models\Proyecto;
use App\Models\User;
use App\Models\App;
use App\Models\Persona;
use App\Models\Firmapersona;
use App\Models\Firmaproyecto;
use App\Models\Dffjur;
use App\Models\Dfafip;
use App\Models\Dfciiu2;
use App\Models\Dfciiu;
use App\Models\Dfmoney;
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
            $idRole = DB::table('role_user')
            ->where('app','=',2)
            ->where('user_id','=',Auth::user()->id)
            ->get()->first()->role_id;
            session()->put('idRole',$idRole);

        }

        $cuit  = $request->get('cuit');
        $rSocial = $request->get('razonSocial');
        $ciudad = $request->get('ciudad');
        $operatoria= $request->get('operatoria');
        $sql= $request->get('sql');
        $selectop = Expediente::orderBy('operatoriaPrograma')->pluck('operatoriaPrograma')->unique();
        // filtros scope app y programa
        $app_id =App::get('firma_idFirma');
        $prog_id = Firmaproyecto::get('proyecto_idProy');
        $expte = Expediente::where('operatoriaPrograma','LIKE','%'.$operatoria.'%')
        ->whereIn('idProy', $prog_id)
        ->join('firma_proyecto','idProy','proyecto_idProy')
        ->pluck('firma_idFirma');

        /** COLABORADORES Y USUARIOS */
        /**tramite banco */

        if($sql==1){

            $tramites = Tramite::where('consultaAgenteFinan','>',Carbon::today()->subDays(240))
            ->where('informeSujetoCredito','=',null)
            ->where('fechaDesistido','=',null)
            ->where('fechaDadoDeBaja','=',null)
            ->whereIn('idProy', $prog_id)
            ->join('firma_proyecto','idProy','proyecto_idProy')
            ->pluck('firma_idFirma');

            session()->flash('info', 'Lista de proyectos en trámite banco '.$operatoria);

        }
        /**tramite uep */
        elseif($sql==2){

            $tramites = Tramite::where('informeSujetoCredito','>',Carbon::today()->subDays(180))
            ->where('sujetoCredito','=','Favorable')
            ->where('remisionOrganismo','=',null)
            ->where('fechaDesistido','=',null)
            ->whereIn('idProy', $prog_id)
            ->join('firma_proyecto','idProy','proyecto_idProy')
            ->pluck('firma_idFirma');

            session()->flash('info', 'Lista de proyectos en trámite uep '.$operatoria);

        }
        /**tramite cfi */
        elseif($sql==3){


            $tramites = Tramite::where('remisionOrganismo','>',Carbon::today()->subDays(180))
            ->where('resolucionElegibilidad','=',null)
            ->where('fechaDesistido','=',null)
            ->where('fechaDadoDeBaja','=',null)
            ->whereIn('idProy', $prog_id)
            ->join('firma_proyecto','idProy','proyecto_idProy')
            ->pluck('firma_idFirma');


            session()->flash('info', 'Lista de proyectos en trámite cfi '.$operatoria);

        }
        /**tramite cobro */
        elseif($sql==4){

            $tramites = Tramite::where('resolucionElegibilidad','>',Carbon::today()->subDays(180))
            ->where('efectivizacion','=',null)
            ->where('fechaDesistido','=',null)
            ->where('fechaDadoDeBaja','=',null)
            ->whereIn('idProy', $prog_id)
            ->join('firma_proyecto','idProy','proyecto_idProy')
            ->pluck('firma_idFirma');


            session()->flash('info', 'Lista de proyectos en trámite de cobro '.$operatoria);
        }
        /**efectivizados - ultimos año */
        elseif($sql==5){

            $tramites = Tramite::where('efectivizacion','>',Carbon::today()->subDays(365))
            ->whereIn('idProy', $prog_id)
            ->join('firma_proyecto','idProy','proyecto_idProy')
            ->pluck('firma_idFirma');


            session()->flash('info', 'Proyectos efectivizados último año '.$operatoria);
        }

        /**dados de baja - ultimo años  */
        elseif($sql==6){

            $tramites = Tramite::where('fechaDadoDeBaja','>',Carbon::today()->subDays(365))
            ->whereIn('idProy', $prog_id)
            ->join('firma_proyecto','idProy','proyecto_idProy')
            ->pluck('firma_idFirma');

            session()->flash('info', 'Lista de solicitudes dadas de baja último año '.$operatoria);
        }

        /**desistidos ultimo año  */
        elseif($sql==7){

            $tramites = Tramite::where('fechaDesistido','>',Carbon::today()->subDays(365))
            ->whereIn('idProy', $prog_id)
            ->join('firma_proyecto','idProy','proyecto_idProy')
            ->pluck('firma_idFirma');


            session()->flash('info', 'Lista de solicitudes desistidas último año '.$operatoria);
        }
        else{
            if ($request->get('operatoria')){
                $firmas = Firma::whereIn('idFirma',$app_id)
                ->whereIn('idFirma',$expte)
                ->where('cuit','like','%'.$cuit.'%')
                ->where('ciudad','like','%'.$ciudad.'%')
                ->where('razonSocial','like','%'.$rSocial.'%')
                ->select('idFirma','cuit','razonSocial','ciudad')
                ->orderBy('idFirma','desc')
                ->Paginate( 20,['idFirma','cuit','razonSocial','ciudad']);

                session()->flash('info', 'opetaoria: '.$operatoria);

            } else {
                if ((session('idRole'))>=1 && (session('idRole'))<=3){
                    $firmas = Firma::whereIn('idFirma',$app_id)
                    ->where('cuit','like','%'.$cuit.'%')
                    ->where('ciudad','like','%'.$ciudad.'%')
                    ->where('razonSocial','like','%'.$rSocial.'%')
                    ->select('idFirma','cuit','razonSocial','ciudad')
                    ->orderBy('idFirma','desc')
                    ->Paginate( 20,['idFirma','cuit','razonSocial','ciudad']);

                }
                else {

                    return back()
                ->with('info','error en la carga de la lista');
                }
            }
        }

        if ($sql>=1 && $sql <= 7){

            $firmas = Firma::whereIn('idFirma',$app_id)
            ->whereIn('idFirma',$expte)
            ->whereIn('idFirma',$tramites)
            ->where('ciudad','like','%'.$ciudad.'%')
            ->orderBy('idFirma','desc')
            ->Paginate( 20,['idFirma','cuit','razonSocial','ciudad']);

        }

        return view('pymes.mysmes', compact('firmas','selectop'))
        ->with('i', (request()->input('page', 1) - 1) * 20);

    }
    /*FILTROS*/

    public function metricas(Request $request){
        $selectop = Expediente::orderBy('operatoriaPrograma')->pluck('operatoriaPrograma')->unique();
        $selectdpto = Firma::orderBy('departamento')->pluck('departamento')->unique();
        $dfciiu2 = Dfciiu2::orderBy('descripcion')->pluck('descripcion','grupo');
        $montos = DB::table('proyectos')->pluck('montoTotal','idProy');
        $ciius = DB::table('proyectos')->pluck('ciiuG','idProy');

        $situacion = $request->get('situacion');
        $operatoria = $request->get('operatoria');
        $dpto = $request->get('departamento');
        $sector = $request->get('sector');
        $evento = $request->get('evento');
        $desde = $request->get('fechadesde');
        $hasta = $request->get('fechahasta');

        //SCOPES in MODELS
        $app_id =App::pluck('firma_idFirma');
        $prog_id = Firmaproyecto::pluck('proyecto_idProy');
        if ($evento && $desde && $hasta) $tramites = Tramite::datestram($evento, $desde, $hasta)->pluck('idProy');
        if($operatoria) $expteope = Expediente::operaexpte($operatoria)->pluck('idProy');
        if($sector) $proysector = Proyecto::sectores($sector)->pluck('idProy');
        //filter
        if($desde) {
            if (!$operatoria && !$dpto && !$sector){
                $filter = Firma::whereIn('idFirma',$app_id) //aplicación
                ->join('firma_proyecto','idFirma','firma_idFirma')
                ->whereIn('proyecto_idProy',$prog_id) //programa
                ->whereIn('proyecto_idProy',$tramites) //evento y fechas
                ->join('proyectos','proyecto_idProy','=','idProy');

            }elseif ($operatoria && !$dpto && !$sector){
                $filter = Firma::whereIn('idFirma',$app_id)
                ->join('firma_proyecto','idFirma','firma_idFirma')
                ->whereIn('proyecto_idProy',$prog_id)
                ->whereIn('proyecto_idProy',$tramites) //
                ->whereIn('proyecto_idProy',$expteope) //->operatoria
                ->join('proyectos','proyecto_idProy','=','idProy');

            }
            elseif ($operatoria && $dpto && !$sector){
                $filter = Firma::dptos($dpto) //->departamento
                ->whereIn('idFirma',$app_id)
                ->join('firma_proyecto','idFirma','firma_idFirma')
                ->whereIn('proyecto_idProy',$prog_id)
                ->whereIn('proyecto_idProy',$tramites) //
                ->whereIn('proyecto_idProy',$expteope) //->operatoria
                ->join('proyectos','proyecto_idProy','=','idProy');
            }

            elseif ($operatoria && !$dpto && $sector){
                $filter = Firma::whereIn('idFirma',$app_id)
                ->join('firma_proyecto','idFirma','firma_idFirma')
                ->whereIn('proyecto_idProy',$prog_id)
                ->whereIn('proyecto_idProy',$tramites) //
                ->whereIn('proyecto_idProy',$expteope) //->operatoria´
                ->whereIn('proyecto_idProy',$proysector) //->sector
                ->join('proyectos','proyecto_idProy','=','idProy');

            }
            elseif (!$operatoria && $dpto && !$sector){
                $filter = Firma::dptos($dpto) //->departamento
                ->whereIn('idFirma',$app_id)
                ->join('firma_proyecto','idFirma','firma_idFirma')
                ->whereIn('proyecto_idProy',$prog_id)
                ->whereIn('proyecto_idProy',$tramites) //
                ->join('proyectos','proyecto_idProy','=','idProy');

            }
            elseif (!$operatoria && !$dpto && $sector){
                $filter = Firma::whereIn('idFirma',$app_id)
                ->join('firma_proyecto','idFirma','firma_idFirma')
                ->whereIn('proyecto_idProy',$prog_id)
                ->whereIn('proyecto_idProy',$tramites) //
                ->whereIn('proyecto_idProy',$proysector) //->sector
                ->join('proyectos','proyecto_idProy','=','idProy');

            }
            elseif (!$operatoria && $dpto && $sector){
                $filter = Firma::dptos($dpto) //->departamento
                ->whereIn('idFirma',$app_id)
                ->join('firma_proyecto','idFirma','firma_idFirma')
                ->whereIn('proyecto_idProy',$prog_id)
                ->whereIn('proyecto_idProy',$tramites) //
                ->whereIn('proyecto_idProy',$proysector) //->sector
                ->join('proyectos','proyecto_idProy','=','idProy');

            }
            elseif ($operatoria && $dpto && $sector){
                $filter = Firma::dptos($dpto) //->departamento
                ->whereIn('idFirma',$app_id)
                ->join('firma_proyecto','idFirma','firma_idFirma')
                ->whereIn('proyecto_idProy',$prog_id)
                ->whereIn('proyecto_idProy',$tramites) //
                ->whereIn('proyecto_idProy',$expteope) //->operatoria´
                ->whereIn('proyecto_idProy',$proysector) //->sector
                ->join('proyectos','proyecto_idProy','=','idProy');

            }

            $cant = $filter ->count();
            $summ = $filter ->sum('montoTotal');

            $lista = $filter
            ->orderBy('razonSocial','asc')
            ->Paginate( 20,['idFirma','razonSocial','ciudad','proyecto_idProy']);

            $title = "FILTRO: desde ". $desde ." hasta ". $hasta .
            " operatoria = ".$operatoria . " dpto = " .$dpto . " sector = ". $sector ;

        }else {
            $title = "Seleccione las opciones de filtrado que desee y luego ejecute FILTRAR";
            $lista = Firma::where('idFirma',null)
            ->join('firma_proyecto','idFirma','firma_idFirma')
            ->Paginate( 20,['idFirma','razonSocial','ciudad','proyecto_idProy']);
            $cant = null;
            $summ = null;
        }


        return view('pymes.metricas', compact('lista','title','evento','montos', 'ciius', 'selectop','selectdpto','dfciiu2','cant','summ'))
        ->with('i', (request()->input('page', 1) - 1) * 20);

    }
    //PLANILLA
        /*FILTROS*/

    public function planilla(Request $request){

            $selectop = Expediente::orderBy('operatoriaPrograma')->pluck('operatoriaPrograma')->unique();
            $selectdpto = Firma::orderBy('departamento')->pluck('departamento')->unique();
            $dfciiu2 = Dfciiu2::orderBy('descripcion')->pluck('descripcion','grupo');
            $montos = DB::table('proyectos')->pluck('montoTotal','idProy');
            $ciius = DB::table('proyectos')->pluck('ciiuG','idProy');

            $situacion = $request->get('situacion');
            $operatoria = $request->get('operatoria');
            $dpto = $request->get('departamento');
            $sector = $request->get('sector');
            $evento = $request->get('evento');
            $inicio = $request->get('inicio');
            $desde = $request->get('fechadesde');
            $hasta = $request->get('fechahasta');

            //SCOPES in MODELS
            $app_id =App::pluck('firma_idFirma');
            $prog_id = Firmaproyecto::pluck('proyecto_idProy');

            if($operatoria) $expteope = Expediente::operaexpte($operatoria)->pluck('idProy');
            if($sector) $proysector = Proyecto::sectores($sector)->pluck('idProy');
            //filter
            if($evento) {
                if ($evento==1){
                    if ($inicio) $tramites = Tramite::presentadas($inicio)->pluck('idProy');
                    $fechatram = 'presentacionIdeaProy';
                    $etevento= 'PRESENTADAS';
                } elseif ($evento==2){
                    if ($inicio) $tramites = Tramite::dadasdebaja($inicio)->pluck('idProy');
                    $fechatram='fechaDadoDeBaja';
                    $etevento= 'CARPETAS DADAS DE BAJA';
                } elseif ($evento==3){
                    if ($inicio) $tramites = Tramite::desistidas($inicio)->pluck('idProy');
                    $fechatram='fechaDesistido';
                    $etevento= 'CARPETAS DESISTIDAS';
                } elseif ($evento==4){
                    if ($inicio && $desde && $hasta) $tramites = Tramite::desembolsados($inicio,$desde,$hasta)->pluck('idProy');
                    $fechatram='efectivizacion';
                    $etevento= 'PROYECTOS DESEMBOLASADOS';
                } elseif ($evento==5){
                    if ($inicio && $desde && $hasta) $tramites = Tramite::tramitecobro($inicio,$desde,$hasta)->pluck('idProy');
                    $fechatram='resolucionElegibilidad';
                    $etevento= 'PROYECTOS EN TRAMITE COBRO';
                } elseif ($evento==6){
                    if ($inicio && $desde && $hasta) $tramites = Tramite::tramitecfi($inicio,$desde,$hasta)->pluck('idProy');
                    $fechatram='remisionOrganismo';
                    $etevento= 'PROYECTOS EN TRAMITE CFI';
                } elseif ($evento==7){
                    if ($inicio && $desde && $hasta) $tramites = Tramite::tramiteuop($inicio,$desde,$hasta)->pluck('idProy');
                    $fechatram='informeSujetoCredito';
                    $etevento= 'SOLICITUDES EN TRAMITE UOP';
                } elseif ($evento==8){
                    if ($inicio && $desde && $hasta) $tramites = Tramite::tramitebanco($inicio,$desde,$hasta)->pluck('idProy');
                    $fechatram='consultaAgenteFinan';
                    $etevento= 'CARPETAS EN ANALISIS SUJETO CREDITO';
                } else{
                    $fechatram = 'presentacionIdeaProy';
                    $etevento= 'PRESENTADAS';
                }
                if (!$operatoria && !$dpto && !$sector){
                    $filter = Firma::whereIn('idFirma',$app_id) //aplicación
                    ->join('firma_proyecto','idFirma','firma_idFirma')
                    ->whereIn('proyecto_idProy',$prog_id) //programa
                    ->whereIn('proyecto_idProy',$tramites) //evento y fechas
                    ->join('proyectos','proyecto_idProy','=','proyectos.idProy')
                    ->join('tramites','proyecto_idProy','=','tramites.idProy');
                }elseif ($operatoria && !$dpto && !$sector){
                    $filter = Firma::whereIn('idFirma',$app_id)
                    ->join('firma_proyecto','idFirma','firma_idFirma')
                    ->whereIn('proyecto_idProy',$prog_id)
                    ->whereIn('proyecto_idProy',$tramites) //
                    ->whereIn('proyecto_idProy',$expteope) //->operatoria
                    ->join('proyectos','proyecto_idProy','=','proyectos.idProy')
                    ->join('tramites','proyecto_idProy','=','tramites.idProy');
                }
                elseif ($operatoria && $dpto && !$sector){
                    $filter = Firma::dptos($dpto) //->departamento
                    ->whereIn('idFirma',$app_id)
                    ->join('firma_proyecto','idFirma','firma_idFirma')
                    ->whereIn('proyecto_idProy',$prog_id)
                    ->whereIn('proyecto_idProy',$tramites) //
                    ->whereIn('proyecto_idProy',$expteope) //->operatoria
                    ->join('proyectos','proyecto_idProy','=','proyectos.idProy')
                    ->join('tramites','proyecto_idProy','=','tramites.idProy');
                }
                elseif ($operatoria && !$dpto && $sector){
                    $filter = Firma::whereIn('idFirma',$app_id)
                    ->join('firma_proyecto','idFirma','firma_idFirma')
                    ->whereIn('proyecto_idProy',$prog_id)
                    ->whereIn('proyecto_idProy',$tramites) //
                    ->whereIn('proyecto_idProy',$expteope) //->operatoria´
                    ->whereIn('proyecto_idProy',$proysector) //->sector
                    ->join('proyectos','proyecto_idProy','=','proyectos.idProy')
                    ->join('tramites','proyecto_idProy','=','tramites.idProy');
                }
                elseif (!$operatoria && $dpto && !$sector){
                    $filter = Firma::dptos($dpto) //->departamento
                    ->whereIn('idFirma',$app_id)
                    ->join('firma_proyecto','idFirma','firma_idFirma')
                    ->whereIn('proyecto_idProy',$prog_id)
                    ->whereIn('proyecto_idProy',$tramites) //
                    ->join('proyectos','proyecto_idProy','=','proyectos.idProy')
                    ->join('tramites','proyecto_idProy','=','tramites.idProy');
                }
                elseif (!$operatoria && !$dpto && $sector){
                    $filter = Firma::whereIn('idFirma',$app_id)
                    ->join('firma_proyecto','idFirma','firma_idFirma')
                    ->whereIn('proyecto_idProy',$prog_id)
                    ->whereIn('proyecto_idProy',$tramites) //
                    ->whereIn('proyecto_idProy',$proysector) //->sector
                    ->join('proyectos','proyecto_idProy','=','proyectos.idProy')
                    ->join('tramites','proyecto_idProy','=','tramites.idProy');
                }
                elseif (!$operatoria && $dpto && $sector){
                    $filter = Firma::dptos($dpto) //->departamento
                    ->whereIn('idFirma',$app_id)
                    ->join('firma_proyecto','idFirma','firma_idFirma')
                    ->whereIn('proyecto_idProy',$prog_id)
                    ->whereIn('proyecto_idProy',$tramites) //
                    ->whereIn('proyecto_idProy',$proysector) //->sector
                    ->join('proyectos','proyecto_idProy','=','proyectos.idProy')
                    ->join('tramites','proyecto_idProy','=','tramites.idProy');
                }
                elseif ($operatoria && $dpto && $sector){
                    $filter = Firma::dptos($dpto) //->departamento
                    ->whereIn('idFirma',$app_id)
                    ->join('firma_proyecto','idFirma','firma_idFirma')
                    ->whereIn('proyecto_idProy',$prog_id)
                    ->whereIn('proyecto_idProy',$tramites) //
                    ->whereIn('proyecto_idProy',$expteope) //->operatoria´
                    ->whereIn('proyecto_idProy',$proysector) //->sector
                    ->join('proyectos','proyecto_idProy','=','proyectos.idProy')
                    ->join('tramites','proyecto_idProy','=','tramites.idProy');
                }

                $cant = $filter ->count();
                $summ = $filter ->sum('montoTotal');

                $lista = $filter
                ->orderBy('razonSocial','asc')
                ->Paginate( 20,['idFirma','razonSocial','ciudad','proyecto_idProy','consultaAgenteFinan',$fechatram]);

                $title = $etevento. ": desde ". $desde ." hasta ". $hasta .
                " operatoria = " .$operatoria . " dpto = " .$dpto . " sector = ". $sector ;

            }else {
                $title = "Seleccione las opciones de filtrado que desee y luego ejecute FILTRAR";
                $lista = Firma::where('idFirma',null)
                ->join('firma_proyecto','idFirma','firma_idFirma')
                ->Paginate( 20,['idFirma','razonSocial','ciudad','proyecto_idProy','consultaAgenteFinan']);
                $cant = null;
                $summ = null;
            }


            return view('pymes.planilla', compact('lista','title','evento','montos', 'ciius', 'selectop','selectdpto','dfciiu2','cant','summ'))
            ->with('i', (request()->input('page', 1) - 1) * 20);
    }

    public function cargafirma(Request $request){

        $xcuit  = $request->input('xcuit');
        if ($xcuit){
            $siCuit= Firma::where('cuit','LIKE','%'.$xcuit.'%')->where('cuit','<>',null)->first();
            if ($siCuit){
                $firmaidF = Firma::where('cuit','LIKE','%'.$xcuit.'%')->get();
                foreach ($firmaidF as $id) {
                    $idF = $id->idFirma;
                }

                if (isset($idF)) {
                    $appfirma = App::where('firma_idFirma',$idF)->get();

                    foreach ($appfirma as $id) {
                        $xapp = $id->app_id;
                    }
                }

                if (isset($xapp)){
                    $app= $xapp;
                }else {
                    $app= 0;
                }
                session()->forget('xcuit');
                if ($app == 2){
                    return redirect()->route('pymes.mysmes', ['cuit' => $xcuit])
                    ->with('info','el cuit '.$xcuit.' ya existe!');
                } else {
                    $app_firma = new App();
                    $app_firma->firma_idFirma = $idF;
                    $app_firma->app_id = 2;
                    $app_firma->save();

                    return redirect()->route('pymes.mysmes', ['cuit' => $xcuit])
                    ->with('info','existe un registro con el cuit '.$xcuit.' y se agregó al sistema');
                }
            } else {
                // guarda cuit para cargafirma
                session()->put('xcuit', $xcuit);
            }
        }

        $dffjur = Dffjur::pluck('descripcion','id');
        $dfafip = Dfafip::pluck('descripcion','id');
        $idLast= Firma::max('idFirma') + 1;
        $cities = Firma::orderBy('ciudad')->pluck('ciudad')->unique();
        $rsoc = Firma::orderBy('razonSocial')->pluck('razonSocial')->unique();
        $districts = Firma::orderBy('departamento')->pluck('departamento')->unique();
        $states = Firma::orderBy('provincia')->pluck('provincia')->unique();
        $countries = Firma::orderBy('pais')->pluck('pais')->unique();

        $cuit  = $request->input('cuit');
        $idFirma  = $request->input('idFirma');
        // acción del store => carga el formulario firma a mysql
        if ($cuit && $idFirma){
            $firmas = Firma::create($request->all());
            $firmas->save();
            $firmas = Firma::find($request->input('idFirma'));
            $firmas->users()->sync(auth()->user()->id);

            $app = new App();
            $app->firma_idFirma = $request->input('idFirma');
            $app->app_id = 2;
            $app->save();

            // cargar datos personas en Personas
            $persjur = $request->input('formaJuridica');
            if ($persjur == 1){
                if (strlen($cuit)==11){
                    $dni = substr($cuit, 2, 8);
                    }
                    $noDni =count(Persona::where('documentoIdentidad',$dni)->get());
                    if (isset($dni) && $noDni == 0 ){
                        $idLastPers= Persona::max('idPers') + 1;
                        $persona = new Persona();
                        $persona -> idPers= $idLastPers;
                        $persona -> documentoIdentidad = $dni;
                        $persona -> nombresApellido = $request->input('razonSocial');
                        $persona -> direccionParticular = $request->input('direccionLegal');
                        $persona -> email = $request->input('email');
                        $persona -> telefono = $request->input('telefono');
                        $persona -> ciudad = $request->input('ciudad');
                        $persona -> distrito = $request->input('departamento');
                        $persona -> estado = $request->input('provincia');
                        $persona -> pais = $request->input('pais');
                        $persona->save();

                        $firmapers = new Firmapersona();
                        $firmapers->firma_idFirma = $request->input('idFirma');
                        $firmapers->persona_idPers = $idLastPers;
                        $firmapers->tipoRelacion = 1;
                        $firmapers->save();

                    }
            }
            session()->put('idFirma', $idFirma);
            session()->forget('xcuit');
            return redirect()->route('pymes.cargaproyecto');
        } else {
            //carga los formularios
            session()->put('xcuit', $xcuit);
            return view('pymes.cargafirma', compact('dffjur','dfafip', 'idLast','rsoc','cities','districts','states','countries'));
        }
    }

    /* PARA ADMINISTRADORES */
    public function index(Request $request)
    {
        $cuit  = $request->get('cuit');
        $rSocial = $request->get('razonSocial');
        $ciudad = $request->get('ciudad');
        $app = App::pluck('app_id', 'firma_idFirma');

        $firmas = DB::table('firmas')
        ->where('cuit','like','%'.$cuit.'%')
        ->where('ciudad','like','%'.$ciudad.'%')
        ->where('razonSocial','like','%'.$rSocial.'%')
        ->orderBy('idFirma','desc')
        ->select('idFirma','cuit','razonSocial','ciudad')
        ->Paginate( 20,['idFirma','cuit','razonSocial','ciudad']);


        return view('firmas.index', compact('firmas','app'))
         ->with('i', (request()->input('page', 1) - 1) * 20);

    }


    public function create()
    {
        $dffjur = Dffjur::pluck('descripcion','id');
        $dfafip = Dfafip::pluck('descripcion','id');
        $idLast= Firma::max('idFirma') + 1;
        $cities = Firma::orderBy('ciudad')->pluck('ciudad')->unique();
        $districts = Firma::orderBy('departamento')->pluck('departamento')->unique();
        $states = Firma::orderBy('provincia')->pluck('provincia')->unique();
        $countries = Firma::orderBy('pais')->pluck('pais')->unique();

        return view('firmas.create', compact('dffjur','dfafip', 'idLast','cities','districts','states','countries'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'razonSocial' => 'string',
        ]);
            $firmas = Firma::create($request->all());
            $firmas->save();
            $firmas = Firma::find($request->input('idFirma'));
            $firmas->users()->sync(auth()->user()->id);

            $app = new App();
            $app->firma_idFirma = $request->input('idFirma');
            $app->app_id = 2;
            $app->save();

            return redirect()->route('pymes.mysmes')
            ->with('success','Se agregó la firma correctamente.');

    }

    public function show($id)
    {
        $go =-1;
        $firma = Firma::find($id);
        $dffjur = Dffjur::pluck('descripcion','id');
        $dfafip = Dfafip::pluck('descripcion','id');

        return view('firmas.show',compact('firma','dffjur','dfafip','go'));
    }


    public function edit($id)
    {

        $go =-1;
        $firma = Firma::find($id);
        $dffjur = Dffjur::pluck('descripcion','id');
        $dfafip = Dfafip::pluck('descripcion','id');
        $cities = Firma::orderBy('ciudad')->pluck('ciudad')->unique();
        $districts = Firma::orderBy('departamento')->pluck('departamento')->unique();
        $states = Firma::orderBy('provincia')->pluck('provincia')->unique();
        $countries = Firma::orderBy('pais')->pluck('pais')->unique();

        return view('firmas.edit', compact('firma','dffjur','dfafip', 'cities','districts','states','countries'));
    }

    public function update(Request $request, Firma $firma)
    {
        $request->validate([
            'cuit' => 'required|min:11|max:11',
        ]);

        $firma->update($request->all());

        return redirect()->route('pymes.mysmes')
                  ->with('success','Se modificó la Firma correctamente');
    }

    public function destroy(Firma $firma)
    {
        $firma->delete();

        return redirect()->route('firmas.index')
                        ->with('success','Se eliminó la Firma correctamente');
    }

    public function addapp($id)
    {
        $firmaInApp = App::all()
        ->where('app_id',2)
        ->where('firma_idFirma',$id)
        ->count();

        if($firmaInApp){
            $firmaElim = App::where('app_id',2)
            ->where('firma_idFirma',$id);
            $firmaElim -> delete();

            return redirect()->route('firmas.index')
            ->with('success','Se quitó la firma > '. Firma::FindOrFail($id)->razonSocial. ' < de la app SPYME');

        }else{
            $app = new App();
            $app->firma_idFirma = $id;
            $app->app_id = 2;
            $app->save();
            return redirect()->route('firmas.index')
            ->with('success','Se agregó la firma > '. Firma::FindOrFail($id)->razonSocial. ' < correctamente a la app SPYME');
        }
    }

}
