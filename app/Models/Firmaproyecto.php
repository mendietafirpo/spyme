<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Scopes\ProgidScope;

class Firmaproyecto extends Model
{
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ProgidScope);
    }

    protected $table = 'firma_proyecto';

    public function proyectos()
    {
        return $this->belongsToMany(Proyecto::class,'proyecto_idProy','idProy');

    }

    public function firmas(){

        return $this->belongsToMany(Firma::class,'firma_idFirma','idFirma');
    }

}
