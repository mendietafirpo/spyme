<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    /**
     * The primary key used by the model.
     *
     * @var string
     */
    protected $primaryKey = 'idPers';

    protected $table = 'personas';

    public function dfecurs()
    {
        return $this->hasMany(Dfecurs::class);
    }

    public function dfeciv()
    {
        return $this->hasMany(Dfeciv::class);
    }

    public function firmas(){

        return $this->belongsToMany(Firma::class)->withPivot('tipoRelacion');
    }

    protected $fillable = [
        'idPers',
        'nombresApellido',
        'documentoIdentidad',
        'fechaNacimiento',
        'estadoCivil',
        'dedicacion',
        'nacionalidad',
        'estudiosCursados',
        'direccionParticular',
        'ciudad',
        'distrito',
        'estado',
        'pais',
        'telefono',
        'telefono_op',
        'email',
        'email_op',
];

  public function scopeDocumento($query,$documento)
  {
      if ($documento)
          return $query->where('documentoIdentidad', $documento);
  }

  public function scopeApellido($query,$apellido)
  { if($apellido)
          return $query->where('nombresApellido', 'LIKE', "%$apellido%");

  }

  public function scopeCiudad($query,$ciudad)
  { if($ciudad)
          return $query->where('ciudad', 'LIKE', "%$ciudad%");

  }

  public function scopeIdfirma($query,$idFirma)
  { if($idFirma)
          return $query->where('idFirma', $idFirma);

  }


 }
