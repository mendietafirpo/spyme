<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Firma extends Model
{

    use HasFactory;
    /**
     * The primary key used by the model.
     *
     * @var string
     */
    protected $primaryKey = 'idFirma';

    protected $table = 'firmas';


    public function dffjur()
    {
        return $this->belongsToMany(Dffjur::class);
    }

    public function dfecurs()
    {
        return $this->belongsToMany(Dfecurs::class);
    }

    public function dfeciv()
    {
        return $this->belongsToMany(Dfeciv::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
        ->withTimestamps();
    }

    public function app()
    {
           return $this->hasMany(App::class);
    }

    public function programa()
    {
           return $this->hasMany(Firmaproyecto::class,'firma_idFirma','idFirma')
           ->where('programa','=',1);
    }

    public function personas()
    {
        return $this->belongsToMany(Persona::class)->withPivot('tipoRelacion');

    }

    public function proyectos()
    {
        return $this->belongsToMany(Proyecto::class)->withPivot('programa');

    }


    protected $fillable = [
        'idFirma',
        'cuit',
        'razonSocial',
        'formaJuridica',
        'situacionAfip',
        'fechaFundacion',
        'direccionLegal',
        'ciudad',
        'departamento',
        'provincia',
        'pais',
        'telefono',
        'telefono_op',
        'email',
        'email_op',
        ];

        //static - where

        public static function dptos($dpto) {

            if($dpto)

            return static::where('departamento','=',$dpto);
        }

        public static function cuits($cuit)
        {
            if ($cuit)
                return static::where('cuit', 'LIKE', "%$cuit%");
        }

        public static function rsocs($rSocial)
        {
            if($rSocial)
                return static::where('razonSocial', 'LIKE', "%$rSocial%");

        }

        public static function locs($ciudad)
        { if($ciudad)
                return static::where('ciudad', 'LIKE', "%$ciudad%");

        }

}
