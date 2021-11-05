<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Proyecto extends Model
{
    use HasFactory;
    /**
     * The primary key used by the model.
     *
     * @var string
     */
    protected $primaryKey = 'idProy';

    protected $table = 'proyectos';

    public function dfecurs()
    {
        return $this->hasMany(Dfmoney::class);
    }

    public function firmas(){

        return $this->belongsToMany(Firma::class);
    }

    public function tramites(){

        return $this->hasMany(Tramite::class, 'idProy','idProy');
    }


    protected $fillable = [
        'idProy',
        'fechaReferencia',
        'nombreProyecto',
        'bienesQueProduce',
        'garantiasOfrecidas',
        'destinoFondos',
        'descripcionProyecto',
        'antecentes',
        'justificacion',
        'montoActFijo',
        'montoCapTrab',
        'montoTotal',
        'inversionTotal',
        'personalOcupado',
        'moneda',
        'tipodeCambio',
        'ciiuCt',
        'ciiuG',
        'ciiuCs',
        'tasacion',
        'nroPartida',
        'nroMatricula',
];

// static where

public static function dpts($dpto) {

    if($dpto)

    return static::where('departamento','=',$dpto);
}


public static function sectores($sector) {

    if($sector)

    return static::where('ciiuG','=',$sector);
}

public static function proys($nombreProyecto)
{
    if($nombreProyecto)
        return static::where('nombreProyecto', 'LIKE', "%$nombreProyecto%");

}

public static function desfondos($destinoFondos)
{
    if($destinoFondos)

    return static::where('destinoFondos', 'LIKE', "%$destinoFondos%");

}

public static function rangomontos($desdemonto, $hastamonto)
{
    if($desdemonto || $hastamonto)

    return static::where('montoTotal', '>=', $desdemonto)->where('montoTotal', '<=', $hastamonto);

}


}
