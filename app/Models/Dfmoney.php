<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dfmoney extends Model
{
    use HasFactory;

    protected $table = 'df_money';

    public $timestamps = false;

    public function proyectos()
    {
        return $this->belongsToMany(Proyecto::class);
    }
}
