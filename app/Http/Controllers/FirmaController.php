<?php

namespace App\Http\Controllers;
use App\Models\Firma;
use App\Models\Tramite;
use App\Models\User;
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
            $idRole = DB::table('role_user')
            ->where('user_id','=',Auth::user()->id)
            ->get()->first()->role_id;
            session()->put('idRole',$idRole);

        }

        $cuit  = $request->get('cuit');
        $rSocial = $request->get('razonSocial');
        $ciudad = $request->get('ciudad');
        $sql= $request->get('sql');

        /** COLABORADORES Y USUARIOS */
        /**tramite banco */
        if($sql==1){


        $tramites = Tramite::where('consultaAgenteFinan','>',Carbon::today()->subDays(240))
        ->where('informeSujetoCredito','=',null)
        ->where('fechaDesistido','=',null)
        ->where('fechaDadoDeBaja','=',null)->get('idProy');


        $firmas = DB::table('firma_proyecto')
        ->whereIn('firma_proyecto.proyecto_idProy',$tramites)
        ->join('app_firma','firma_proyecto.firma_idFirma','=','app_firma.firma_idFirma')
        ->where('app_id',2)
        ->join('firmas','app_firma.firma_idFirma','=','idFirma')
        ->where('ciudad','like','%'.$ciudad.'%')
        ->orderBy('idFirma','desc')
        ->Paginate( 20,['idFirma','cuit','razonSocial','ciudad']);

        session()->flash('info', 'Lista de proyectos en trámite banco');

                return view('pymes.mysmes', compact('firmas'))
                ->with('i', (request()->input('page', 1) - 1) * 20);

        }
        /**tramite uep */
        elseif($sql==2){

            $tramites = Tramite::where('informeSujetoCredito','>',Carbon::today()->subDays(180))
            ->where('sujetoCredito','=','Favorable')
            ->where('remisionOrganismo','=',null)
            ->where('fechaDesistido','=',null)
            ->where('fechaDadoDeBaja','=',null)->get('idProy');


            $firmas = DB::table('firma_proyecto')
            ->whereIn('firma_proyecto.proyecto_idProy',$tramites)
            ->join('app_firma','firma_proyecto.firma_idFirma','=','app_firma.firma_idFirma')
            ->where('app_id',2)
            ->join('firmas','app_firma.firma_idFirma','=','idFirma')
            ->orderBy('idFirma','desc')
            ->where('ciudad','like','%'.$ciudad.'%')
            ->Paginate( 20,['idFirma','cuit','razonSocial','ciudad']);

            session()->flash('info', 'Lista de proyectos en trámite uep');

            return view('pymes.mysmes', compact('firmas'))
            ->with('i', (request()->input('page', 1) - 1) * 20);

        }
        /**tramite cfi */
        elseif($sql==3){


            $tramites = Tramite::where('remisionOrganismo','>',Carbon::today()->subDays(180))
            ->where('resolucionElegibilidad','=',null)
            ->where('fechaDesistido','=',null)
            ->where('fechaDadoDeBaja','=',null)->get('idProy');


            $firmas = DB::table('firma_proyecto')
            ->whereIn('firma_proyecto.proyecto_idProy',$tramites)
            ->join('app_firma','firma_proyecto.firma_idFirma','=','app_firma.firma_idFirma')
            ->where('app_id',2)
            ->join('firmas','app_firma.firma_idFirma','=','idFirma')
            ->where('ciudad','like','%'.$ciudad.'%')
            ->orderBy('idFirma','desc')
            ->Paginate( 20,['idFirma','cuit','razonSocial','ciudad']);

            session()->flash('info', 'Lista de proyectos en trámite cfi');
            return view('pymes.mysmes', compact('firmas'))
            ->with('i', (request()->input('page', 1) - 1) * 20);

        }
        /**tramite cobro */
        elseif($sql==4){

            $tramites = Tramite::where('resolucionElegibilidad','>',Carbon::today()->subDays(180))
            ->where('efectivizacion','=',null)
            ->where('fechaDesistido','=',null)
            ->where('fechaDadoDeBaja','=',null)->get('idProy');


            $firmas = DB::table('firma_proyecto')
            ->whereIn('firma_proyecto.proyecto_idProy',$tramites)
            ->join('app_firma','firma_proyecto.firma_idFirma','=','app_firma.firma_idFirma')
            ->where('app_id',2)
            ->join('firmas','app_firma.firma_idFirma','=','idFirma')
            ->where('ciudad','like','%'.$ciudad.'%')
            ->orderBy('idFirma','desc')
            ->Paginate( 20,['idFirma','cuit','razonSocial','ciudad']);

            session()->flash('info', 'Lista de proyectos en trámite de cobro');
            return view('pymes.mysmes', compact('firmas'))
            ->with('i', (request()->input('page', 1) - 1) * 20);
        }
        /**efectivizados - ultimos año */
        elseif($sql==5){

            $tramites = Tramite::where('efectivizacion','>',Carbon::today()->subDays(365))
            ->get('idProy');


            $firmas = DB::table('firma_proyecto')
            ->whereIn('firma_proyecto.proyecto_idProy',$tramites)
            ->join('app_firma','firma_proyecto.firma_idFirma','=','app_firma.firma_idFirma')
            ->where('app_id',2)
            ->join('firmas','app_firma.firma_idFirma','=','idFirma')
            ->where('ciudad','like','%'.$ciudad.'%')
            ->orderBy('idFirma','desc')
            ->Paginate( 20,['idFirma','cuit','razonSocial','ciudad']);

            session()->flash('info', 'Proyectos efectivizados último año');
            return view('pymes.mysmes', compact('firmas'))
            ->with('i', (request()->input('page', 1) - 1) * 20);
        }

        /**dados de baja - ultimo años  */
        elseif($sql==6){

            $tramites = Tramite::where('fechaDadoDeBaja','>',Carbon::today()->subDays(365))
            ->get('idProy');


            $firmas = DB::table('firma_proyecto')
            ->whereIn('firma_proyecto.proyecto_idProy',$tramites)
            ->join('app_firma','firma_proyecto.firma_idFirma','=','app_firma.firma_idFirma')
            ->where('app_id',2)
            ->join('firmas','app_firma.firma_idFirma','=','idFirma')
            ->where('ciudad','like','%'.$ciudad.'%')
            ->orderBy('idFirma','desc')
            ->Paginate( 20,['idFirma','cuit','razonSocial','ciudad']);

            session()->flash('info', 'Lista de solicitudes dadas de baja último año');
            return view('pymes.mysmes', compact('firmas'))
            ->with('i', (request()->input('page', 1) - 1) * 20);
        }

        /**desistidos ultimo año  */
        elseif($sql==7){

            $tramites = Tramite::where('fechaDesistido','>',Carbon::today()->subDays(365))
            ->get('idProy');


            $firmas = DB::table('firma_proyecto')
            ->whereIn('firma_proyecto.proyecto_idProy',$tramites)
            ->join('app_firma','firma_proyecto.firma_idFirma','=','app_firma.firma_idFirma')
            ->where('app_id',2)
            ->join('firmas','app_firma.firma_idFirma','=','idFirma')
            ->orderBy('idFirma','desc')
            ->Paginate( 20,['idFirma','cuit','razonSocial','ciudad']);

            session()->flash('info', 'Lista de solicitudes desistidas último año');
            return view('pymes.mysmes', compact('firmas'))
            ->with('i', (request()->input('page', 1) - 1) * 20);
        }

        else{
            session()->flash('info', '');
            if ((session('idRole'))>=1 && (session('idRole'))<=3){

                $firmas = DB::table('firmas')
                ->join('app_firma','idFirma','=','app_firma.firma_idFirma')
                ->where('app_id',2)
                ->where('cuit','like','%'.$cuit.'%')
                ->where('ciudad','like','%'.$ciudad.'%')
                ->where('razonSocial','like','%'.$rSocial.'%')
                ->select('idFirma','cuit','razonSocial','ciudad')
                ->orderBy('idFirma','desc')
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

    /* PARA ADMINISTRADORES */
    public function index(Request $request)
    {
        $cuit  = $request->get('cuit');
        $rSocial = $request->get('razonSocial');
        $ciudad = $request->get('ciudad');

        $firmas = DB::table('firmas')
        ->where('cuit','like','%'.$cuit.'%')
        ->where('ciudad','like','%'.$ciudad.'%')
        ->where('razonSocial','like','%'.$rSocial.'%')
        ->orderBy('idFirma','desc')
        ->select('idFirma','cuit','razonSocial','ciudad')
        ->Paginate( 20,['idFirma','cuit','razonSocial','ciudad']);


        return view('firmas.index', compact('firmas'))
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
        $cuit  = $request->input('cuit');
        if (Firma::where('cuit', $cuit)->first()){
        return redirect()->route('pymes.mysmes', array('cuit' => $cuit))
        ->with('info','el cuit '.$cuit.' ya existe:');
        }
        else{
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
    }

    public function show($id)
    {
        $firma = Firma::find($id);
        $dffjur = Dffjur::pluck('descripcion','id');
        $dfafip = Dfafip::pluck('descripcion','id');

        return view('firmas.show',compact('firma','dffjur','dfafip'));
    }


    public function edit($id)
    {

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

        $app = new App();
        $app->firma_idFirma = $id;
        $app->app_id = 2;
        $app->save();

        return redirect()->route('firmas.index')
        ->with('success','Se agregó la firma correctamente a la app spyme');
    }

}
