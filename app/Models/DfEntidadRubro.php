<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DfEntidadRubro extends Model
{
    use HasFactory;

    protected $table = 'df_entidad_rubro';

    public $timestamps = false;

    public function balances()
    {
        return $this->belongsToMany(Balance::class);
    }
}
