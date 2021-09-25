<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Grouptramite extends Model
{
    use HasFactory;

    protected $table = 'grouptramites';


    public function enbanco(){

        return $this->hasMany(Tramite::class,'idProy','idProy')
        ->where('consultaAgenteFinan','>',Carbon::today()->subDays(240))
        ->where('informeSujetoCredito','=',null)
        ->where('fechaDesistido','=',null)
        ->where('fechaDadoDeBaja','=',null);
    }


 }
