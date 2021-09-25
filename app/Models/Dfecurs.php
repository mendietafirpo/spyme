<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dfecurs extends Model
{
    use HasFactory;

    protected $table = 'df_ecurs';

    public $timestamps = false;

    public function personas()
    {
        return $this->belongsToMany(Persona::class);
    }
}
