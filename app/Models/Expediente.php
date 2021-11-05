<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    use HasFactory;
    /**
     * The primary key used by the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $table = 'expedientes';

    public function proyectos(){

        return $this->belongsToMany(Proyecto::class,'idProy','idProy');
    }

    protected $fillable = [
        'id',
        'idProy',
        'entidadFuenteDeFondos',
        'operatoriaPrograma',
        'idExpediente',
        'agenteFinanciero',
        'sucursalVentanilla',
        'promotorDelProyecto',
        'evaluadorTecnico',
        'prioridadAsignada'
];

    //scopes static
    public static function operaexpte($operatoria) {

        if($operatoria)

        return static::where('operatoriaPrograma','=',$operatoria);
    }

 }
