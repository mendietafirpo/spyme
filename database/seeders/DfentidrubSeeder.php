<?php

namespace Database\Seeders;
use App\Models\DfEntidadRubro;
use Illuminate\Database\Seeder;

class DfentidrubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $df= new DfEntidadRubro();
        $df ->id = 1;
        $df ->descripcion = 'Inversion';
        $df ->save();
        $df= new DfEntidadRubro();
        $df ->id = 2;
        $df ->descripcion = 'Ingresos';
        $df ->save();
        $df= new DfEntidadRubro();
        $df ->id = 3;
        $df ->descripcion = 'Egresos';
        $df ->save();
        $df= new DfEntidadRubro();
        $df ->id = 4;
        $df ->descripcion = 'Activos Corrientes';
        $df ->save();
        $df= new DfEntidadRubro();
        $df ->id = 5;
        $df ->descripcion = 'Activos No Corrientes';
        $df ->save();
        $df= new DfEntidadRubro();
        $df ->id = 6;
        $df ->descripcion = 'Pasivos Corrientes';
        $df ->save();
        $df= new DfEntidadRubro();
        $df ->id = 7;
        $df ->descripcion = 'Pasivos No Corrientes';
        $df ->save();
        $df= new DfEntidadRubro();
        $df ->id = 8;
        $df ->descripcion = 'Patrimonio Neto';
        $df ->save();
        $df= new DfEntidadRubro();
        $df ->id = 9;
        $df ->descripcion = 'Resultado bruto';
        $df ->save();
        $df= new DfEntidadRubro();
        $df ->id = 10;
        $df ->descripcion = 'Resultado ordinario';
        $df ->save();
        $df= new DfEntidadRubro();
        $df ->id = 11;
        $df ->descripcion = 'Resultado Neto';
        $df ->save();
        $df= new DfEntidadRubro();
        $df ->id = 12;
        $df ->descripcion = 'Indicadores';
        $df ->save();
        $df= new DfEntidadRubro();
        $df ->id = 13;
        $df ->descripcion = 'Fecha de cierre';
        $df ->save();
        $df= new DfEntidadRubro();
        $df ->id = 14;
        $df ->descripcion = 'Otras';
        $df ->save();


    }
}
