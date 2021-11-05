<?php

namespace Database\Seeders;
use App\Models\Dfeciv;
use Illuminate\Database\Seeder;

class DfecivSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dfeciv= new Dfeciv();
        $dfeciv ->id = 1;
        $dfeciv ->descripcion = 'Casado/a';
        $dfeciv ->save();
        $dfeciv= new Dfeciv();
        $dfeciv ->id = 2;
        $dfeciv ->descripcion = 'Divorciado/a';
        $dfeciv ->save();
        $dfeciv= new Dfeciv();
        $dfeciv ->id = 3;
        $dfeciv ->descripcion = 'Soltero/a';
        $dfeciv ->save();
        $dfeciv= new Dfeciv();
        $dfeciv ->id = 4;
        $dfeciv ->descripcion = 'Separado/a';
        $dfeciv ->save();
        $dfeciv= new Dfeciv();
        $dfeciv ->id = 5;
        $dfeciv ->descripcion = 'Viudo/a';
        $dfeciv ->save();
        $dfeciv= new Dfeciv();
        $dfeciv ->id = 6;
        $dfeciv ->descripcion = 'Otro';
        $dfeciv ->save();
    }
}
