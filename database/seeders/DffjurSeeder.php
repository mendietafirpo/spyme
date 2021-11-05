<?php

namespace Database\Seeders;
use App\Models\Dffjur;

use Illuminate\Database\Seeder;

class DffjurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $dffjur= new Dffjur();
       $dffjur ->id = 1;
       $dffjur ->descripcion = 'Persona Humana';
       $dffjur ->save();
       $dffjur= new Dffjur();
       $dffjur ->id = 2;
       $dffjur ->descripcion = 'Persona Juridica';
       $dffjur ->save();

    }
}
