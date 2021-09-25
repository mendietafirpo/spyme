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


 }
