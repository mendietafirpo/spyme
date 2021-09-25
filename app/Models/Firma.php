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

        public function scopeAppfirma($query)
        {
            return $query->where('app_id','=','1');
        }

        public function scopeCuit($query,$cuit)
        {
            if ($cuit)
                return $query->where('cuit', 'LIKE', "%$cuit%");
        }

        public function scopeFjur($query,$fjur)
        {
            if ($fjur)
                return $query->where('FormaJuridica', '=', "$fjur");
        }

        public function scopeRazonSocial($query,$rSocial)
        {
            if($rSocial)
                return $query->where('razonSocial', 'LIKE', "%$rSocial%");

        }

        public function scopeCiudad($query,$ciudad)
        { if($ciudad)
                return $query->where('ciudad', 'LIKE', "%$ciudad%");

        }


        public function scopeIdFirma($query,$idFirma)
        {
            if ($idFirma)
                return $query->where('idFirma', $idFirma);
        }


        public function scopeDateBetween($query, $desde, $hasta) {

            return $query->whereBetween('created_at', [$desde, $hasta]);
        }

}
