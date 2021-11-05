<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Tramite extends Model
{
    use HasFactory;
    /**
     * The primary key used by the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $table = 'tramites';


    public function proyectos(){

        return $this->belongsToMany(Proyecto::class,'idProy','idProy');
    }


    protected $fillable = [
        'id',
        'idProy',
        'presentacionIdeaProy',
        'consultaAgenteFinan',
        'informeSujetoCredito',
        'sujetoCredito',
        'remisionOrganismo',
        'aprobacionTecnica',
        'resolucionElegibilidad',
        'transferenciaFondos',
        'efectivizacion',
        'fechaDesistido',
        'fechaDadoDeBaja'
];

    //scopes y static where
    public static function datestram($evento, $desde, $hasta){

        if($evento)
        return static::where($evento,'>=',Carbon::parse($desde))
        ->where($evento,'<=',Carbon::parse($hasta));
    }
    //where PLANILLA.blade ->FirmaController
    public static function presentadas($inicio){

        if($inicio)
        return static::where('consultaAgenteFinan','>=',Carbon::parse($inicio))
        ->where('consultaAgenteFinan','<=',Carbon::parse($inicio)->addYear());
    }

    public static function dadasdebaja($inicio){

        if($inicio)
        return static::where('fechaDadoDeBaja','>=',Carbon::parse($inicio))
        ->where('fechaDadoDeBaja','<=',Carbon::parse($inicio)->addYear());
    }

    public static function desistidas($inicio){

        if($inicio)
        return static::where('fechaDesistido','>=',Carbon::parse($inicio))
        ->where('fechaDesistido','<=',Carbon::parse($inicio)->addYear());
    }

    public static function desebolsados($inicio,$desde,$hasta){

        if ($inicio && $desde && $hasta)
        return static::where('consultaAgenteFinan','>=',Carbon::parse($inicio))
        ->where('consultaAgenteFinan','<=',Carbon::parse($inicio)->addYear())
        ->where('efectivizacion','>=',Carbon::parse($desde))
        ->where('efectivizacion','<=',Carbon::parse($hasta));
    }

    public static function tramitecobro($inicio,$desde,$hasta){

        if ($inicio && $desde && $hasta)
        return static::where('consultaAgenteFinan','>=',Carbon::parse($inicio))
        ->where('consultaAgenteFinan','<=',Carbon::parse($inicio)->addYear())
        ->where('resolucionElegibilidad','>=',Carbon::parse($desde))
        ->where('resolucionElegibilidad','<=',Carbon::parse($hasta))
        ->where('efectivizacion','=', null);
    }

    public static function tramitecfi($inicio,$desde,$hasta){

        if ($inicio && $desde && $hasta)
        return static::where('consultaAgenteFinan','>=',Carbon::parse($inicio))
        ->where('consultaAgenteFinan','<=',Carbon::parse($inicio)->addYear())
        ->where('remisionOrganismo','>=',Carbon::parse($desde))
        ->where('remisionOrganismo','<=',Carbon::parse($hasta))
        ->where('resolucionElegibilidad','=', null)
        ->where('fechaDesistido','=',null)
        ->where('fechaDadoDeBaja','=',null);
    }

    public static function tramiteuop($inicio,$desde,$hasta){

        if ($inicio && $desde && $hasta)
        return static::where('consultaAgenteFinan','>=',Carbon::parse($inicio))
        ->where('consultaAgenteFinan','<=',Carbon::parse($inicio)->addYear())
        ->where('informeSujetoCredito','>=',Carbon::parse($desde))
        ->where('informeSujetoCredito','<=',Carbon::parse($hasta))
        ->where('sujetoCredito','LIKE', '%favorable%')
        ->where('remisionOrganismo','=', null)
        ->where('fechaDesistido','=',null)
        ->where('fechaDadoDeBaja','=',null);
    }
    public static function tramitebanco($inicio,$desde,$hasta){

        if ($inicio && $desde && $hasta)
        return static::where('consultaAgenteFinan','>=',Carbon::parse($inicio))
        ->where('informeSujetoCredito','=',null)
        ->where('fechaDesistido','=',null)
        ->where('fechaDadoDeBaja','=',null);
    }


 }
