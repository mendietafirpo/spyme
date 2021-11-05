<?php


namespace Database\Seeders;
use App\Models\Firmapersonarel;
use Illuminate\Database\Seeder;

class FirmapersonarelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datos= new Firmapersonarel();
        $datos ->id = 1;
        $datos ->descripcion = 'Titular unipersonal';
        $datos ->save();
        $datos= new Firmapersonarel();
        $datos ->id = 2;
        $datos ->descripcion = 'Socio/a conyugal';
        $datos ->save();
        $datos= new Firmapersonarel();
        $datos ->id = 3;
        $datos ->descripcion = 'Socio/a administrador/a';
        $datos ->save();
        $datos= new Firmapersonarel();
        $datos ->id = 4;
        $datos ->descripcion = 'Socio/a propietario/ia';
        $datos ->save();
        $datos= new Firmapersonarel();
        $datos ->id = 5;
        $datos ->descripcion = 'Administrador/a';
        $datos ->save();
        $datos= new Firmapersonarel();
        $datos ->id = 6;
        $datos ->descripcion = 'Representante legal';
        $datos ->save();
        $datos= new Firmapersonarel();
        $datos ->id = 7;
        $datos ->descripcion = 'Directoro/a de proyectos';
        $datos ->save();
        $datos= new Firmapersonarel();
        $datos ->id = 8;
        $datos ->descripcion = 'Asesor/a externo/a';
        $datos ->save();
        $datos= new Firmapersonarel();
        $datos ->id = 9;
        $datos ->descripcion = 'Sin definir';
        $datos ->save();

    }
}
