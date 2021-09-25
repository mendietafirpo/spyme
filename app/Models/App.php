<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    use HasFactory;

    protected $table = 'app_firma';

    protected $primaryKey = 'firma_idFirma';

    public $timestamps = false;

    public function firmas()
    {
           return $this->hasMany(Firma::class);
    }
}
