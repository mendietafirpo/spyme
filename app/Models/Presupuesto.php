<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presupuesto extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    protected $table = 'presupuestos';

    public function proyectos(){

        return $this->belongsToMany(Proyecto::class,'idProy','idProy');
    }

    protected $fillable = [
        'id',
        'idProy',
        'descripcion',
        'cantidad',
        'precioSinIva',
        'montoIva',
        'montoTotal',
        'montoAportePropio',
        'rubroAplFon',
        'observaciones',
        'item',
    ];

}
