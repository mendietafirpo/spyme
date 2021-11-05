<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roleuser extends Model
{
    use HasFactory;

    protected $table = 'role_user';

    protected $primaryKey = 'role_id';

    public $timestamps = false;

    public function users()
    {
           return $this->hasMany(User::class);
    }
}
