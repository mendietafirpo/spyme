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

public function scopeNombreproyecto($query,$nombreProyecto)
{
    if($nombreProyecto)
        return $query->where('nombreProyecto', 'LIKE', "%$nombreProyecto%");

}

public function scopeDestinofondos($query,$destinoFondos)
{
    if($destinoFondos)
        return $query->where('destinoFondos', 'LIKE', "%$destinoFondos%");

}

public function scopeMontototal($query,$montoTotal)
{
    if($montoTotal)
        return $query->where('montoTotal', 'LIKE', "%$montoTotal%");

}


}
