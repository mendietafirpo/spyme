<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\AppidScope;

class App extends Model
{
    use HasFactory;
#

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new AppidScope);
    }

    //EN DETERMINADAS CONSULTAS SI SE QUIERE ELIMINAR SCOPE
    //App::withoutGlobalScope(AppScope::class)->get();
    //App::withoutGlobalScope('app_id')->get();



    protected $table = 'app_firma';

    protected $primaryKey = 'firma_idFirma';

    public $timestamps = false;

    public function firmas()
    {
           return $this->hasMany(Firma::class);
    }

}
