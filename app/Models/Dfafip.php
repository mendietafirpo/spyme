<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dfafip extends Model
{
    use HasFactory;

    protected $table = 'df_afip';

    public $timestamps = false;

    public function dfafip()
    {
        return $this->belongsToMany(Firma::class);
    }
}
