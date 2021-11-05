<?php


namespace Database\Seeders;
use App\Models\Dfafip;
use Illuminate\Database\Seeder;

class DfafipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dfafip= new Dfafip();
        $dfafip ->id = 1;
        $dfafip ->descripcion = 'Responsable Inscripto';
        $dfafip ->save();
        $dfafip= new Dfafip();
        $dfafip ->id = 2;
        $dfafip ->descripcion = 'Monotributo';
        $dfafip ->save();
    }
}
