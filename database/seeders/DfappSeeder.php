<?php


namespace Database\Seeders;
use App\Models\Dfapp;
use Illuminate\Database\Seeder;

class DfappSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dfafip= new Dfapp();
        $dfafip ->id = 1;
        $dfafip ->descripcion = 'Access';
        $dfafip ->save();
        $dfafip= new Dfapp();
        $dfafip ->id = 2;
        $dfafip ->descripcion = 'Uep';
        $dfafip ->save();
        $dfafip= new Dfapp();
        $dfafip ->id = 3;
        $dfafip ->descripcion = 'Sci';
        $dfafip ->save();
        $dfafip ->id = 4;
        $dfafip ->descripcion = 'Ang';
        $dfafip ->save();
    }
}
