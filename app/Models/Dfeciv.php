<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dfeciv extends Model
{
    use HasFactory;

    protected $table = 'df_eciv';

    public $timestamps = false;

    public function personas()
    {
        return $this->belongsToMany(Persona::class);
    }
}
