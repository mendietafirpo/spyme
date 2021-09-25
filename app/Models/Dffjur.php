<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dffjur extends Model
{
    use HasFactory;

    protected $table = 'df_fjur';

    public $timestamps = false;

    public function firmas()
    {
        return $this->belongsToMany(Firma::class);
    }
}
