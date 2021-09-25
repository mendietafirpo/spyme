<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dfrubinv extends Model
{
    use HasFactory;

    protected $table = 'df_rubro_invers';

    public $timestamps = false;
    
    public function balances()
    {
        return $this->belongsToMany(Balance::class);
    }

    public function presupuestos()
    {
        return $this->belongsToMany(Presupuesto::class);
    }

}
