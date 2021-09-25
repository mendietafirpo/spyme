<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gestion extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $table = 'gestiones';

    public function proyectos(){

        return $this->belongsToMany(Proyecto::class,'idProy','idProy');
    }

    protected $fillable = [
        'id',
        'idProy',
        'fechatramite',
        'proceso',
        'check',
        'descripcion',
        'entidad_emisora',
        'operador_emisor',
        'entidad_receptora',
        'operador_receptor',
        'enlece'
    ];

}
