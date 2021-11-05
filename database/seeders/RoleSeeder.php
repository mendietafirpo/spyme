<?php

namespace Database\Seeders;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = new Role();
        $name->id = 1;
        $name->name = 'admin';
        $name->descripcion = 'Administrator';
        $name->save();
        $name = new Role();
        $name->id = 2;
        $name->name = 'asesor';
        $name->descripcion = 'Asesor';
        $name->save();
        $name = new Role();
        $name->id = 3;
        $name->name = 'user';
        $name->descripcion = 'Usuario';
        $name->save();
        $name = new Role();
        $name->id = 4;
        $name->name = 'subs';
        $name->descripcion = 'Suscriptor';
        $name->save();
        $name = new Role();
        $name->id = 5;
        $name->name = 'view';
        $name->descripcion = 'Visitante';
        $name->save();
    }
}
