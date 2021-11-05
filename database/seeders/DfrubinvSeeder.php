<?php

namespace Database\Seeders;
use App\Models\Dfrubinv;
use Illuminate\Database\Seeder;

class DfrubinvSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $df= new Dfrubinv();
        $df ->id = 1;
        $df ->descripcion = 'Tierra/terrenos';
        $df ->save();
        $df= new Dfrubinv();
        $df ->id = 2;
        $df ->descripcion = 'Edificaciones';
        $df ->save();
        $df= new Dfrubinv();
        $df ->id = 3;
        $df ->descripcion = 'Instalaciones';
        $df ->save();
        $df= new Dfrubinv();
        $df ->id = 4;
        $df ->descripcion = 'Maquinaria';
        $df ->save();
        $df= new Dfrubinv();
        $df ->id = 5;
        $df ->descripcion = 'Equipamiento';
        $df ->save();
        $df= new Dfrubinv();
        $df ->id = 6;
        $df ->descripcion = 'Rodado';
        $df ->save();
        $df= new Dfrubinv();
        $df ->id = 7;
        $df ->descripcion = 'Animales';
        $df ->save();
        $df= new Dfrubinv();
        $df ->id = 8;
        $df ->descripcion = 'Plantaciones';
        $df ->save();
        $df= new Dfrubinv();
        $df ->id = 9;
        $df ->descripcion = 'Participaciones societarias';
        $df ->save();
        $df= new Dfrubinv();
        $df ->id = 10;
        $df ->descripcion = 'Intangibles';
        $df ->save();
        $df= new Dfrubinv();
        $df ->id = 11;
        $df ->descripcion = 'Capital de trabajo';
        $df ->save();
        $df= new Dfrubinv();
        $df ->id = 12;
        $df ->descripcion = 'Productos en proceso';
        $df ->save();
        $df= new Dfrubinv();
        $df ->id = 13;
        $df ->descripcion = 'Productos para la venta';
        $df ->save();
        $df= new Dfrubinv();
        $df ->id = 14;
        $df ->descripcion = 'Cuentas por cobrar';
        $df ->save();
        $df= new Dfrubinv();
        $df ->id = 15;
        $df ->descripcion = 'Disponibilidad en caja';
        $df ->save();
        $df= new Dfrubinv();
        $df ->id = 16;
        $df ->descripcion = 'Materias primas';
        $df ->save();
        $df= new Dfrubinv();
        $df ->id = 17;
        $df ->descripcion = 'Pago de nómina';
        $df ->save();
        $df= new Dfrubinv();
        $df ->id = 18;
        $df ->descripcion = 'Pago de servicios';
        $df ->save();
        $df= new Dfrubinv();
        $df ->id = 19;
        $df ->descripcion = 'Capacitaciones';
        $df ->save();
        $df= new Dfrubinv();
        $df ->id = 20;
        $df ->descripcion = 'Stock materias primas';
        $df ->save();
        $df= new Dfrubinv();
        $df ->id = 21;
        $df ->descripcion = 'Stock materiales';
        $df ->save();
        $df= new Dfrubinv();
        $df ->id = 22;
        $df ->descripcion = 'Stock productos en proceso';
        $df ->save();
        $df= new Dfrubinv();
        $df ->id = 23;
        $df ->descripcion = 'Stock productos terminados';
        $df ->save();
        $df= new Dfrubinv();
        $df ->id = 24;
        $df ->descripcion = 'Stock combustibles';
        $df ->save();
    }
}
