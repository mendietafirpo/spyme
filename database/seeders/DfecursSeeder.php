<?php

namespace Database\Seeders;
use App\Models\Dfecurs;
use Illuminate\Database\Seeder;


class DfecursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dfecurs= new Dfecurs();
        $dfecurs ->id = 1;
        $dfecurs ->descripcion = 'Primario Incompleto';
        $dfecurs ->save();
        $dfecurs= new Dfecurs();
        $dfecurs ->id = 2;
        $dfecurs ->descripcion = 'Primario Completo';
        $dfecurs ->save();
        $dfecurs= new Dfecurs();
        $dfecurs ->id = 3;
        $dfecurs ->descripcion = 'Secundario Incompleto';
        $dfecurs ->save();
        $dfecurs= new Dfecurs();
        $dfecurs ->id = 4;
        $dfecurs ->descripcion = 'Secundario Completo';
        $dfecurs ->save();
        $dfecurs= new Dfecurs();
        $dfecurs ->id = 5;
        $dfecurs ->descripcion = 'Terciario Incompleto';
        $dfecurs ->save();
        $dfecurs= new Dfecurs();
        $dfecurs ->id = 6;
        $dfecurs ->descripcion = 'Terciario Completo';
        $dfecurs ->save();
        $dfecurs= new Dfecurs();
        $dfecurs ->id = 7;
        $dfecurs ->descripcion = 'Universitario Incompleto';
        $dfecurs ->save();
        $dfecurs= new Dfecurs();
        $dfecurs ->id = 8;
        $dfecurs ->descripcion = 'Universitario Completo';
        $dfecurs ->save();
        $dfecurs= new Dfecurs();
        $dfecurs ->id = 9;
        $dfecurs ->descripcion = 'Post Grado';
        $dfecurs ->save();
        $dfecurs= new Dfecurs();
        $dfecurs ->id = 10;
        $dfecurs ->descripcion = 'Doctorado';
        $dfecurs ->save();
    }
}
