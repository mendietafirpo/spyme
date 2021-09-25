<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $table = 'balances';

    public function firmas(){

        return $this->belongsToMany(Firma::class,'idFirma','idFirma');
    }

    protected $fillable = [
        'id',
        'idFirma',
        'entidadRubro',
        'descripcion',
        'rubro',
        'cantidad',
        'monto',
        'observaciones',
        'item',
    ];
}
