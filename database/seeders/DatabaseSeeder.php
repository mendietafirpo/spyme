<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*$this->call(RoleSeeder::class);*/
        /*$this->call(DffjurSeeder::class);
        $this->call(DfecivSeeder::class);
        $this->call(DfafipSeeder::class);
        $this->call(DfecursSeeder::class);
        $this->call(DfmoneySeeder::class);
        $this->call(DfentidrubSeeder::class);
        $this->call(DfrubinvSeeder::class);
        $this->call(DfappSeeder::class);*/
        /*$this->call(RoleUserSeeder::class);*/
        $this->call(FirmapersonarelSeeder::class);
        //\App\Models\User::factory(10)->create();
    }
}
