<?php

namespace Database\Seeders;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /*for ($i = 1; $i <= 5; $i++) {
            $faker = \Faker\Factory::create();

            $users = User::create([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ]);*/
            /*$user->roles()->attach( $i [ rand(1, 5 ) ] );
            $users->roles()->sync(rand(1, 5 ),rand(1, 5 ));
        }*/
        $name = new User();
        $name->id = 1;
        $name->name = 'marcelo';
        $name->email = 'mendietafirpo@gmail.com';
        $name->password = Hash::make('marcelo$20$21');
        /*$name->email_verified_at = now();
        $name->remember_token =Str::random(10);*/
        $name->save();
        $name->roles()->attach(1, ['app' => 1]);
        /**user_id=id de user, role_id=attach(x, app= a =>x */
        $name = new User();
        $name->id = 2;
        $name->name = 'admin';
        $name->email = 'admin@user.com';
        $name->password =  Hash::make('admin_$20$21');
        /*$name->email_verified_at = now();*/
        /*$name->remember_token =Str::random(10);*/
        $name->save();
        $name->roles()->attach(1, ['app' => 1]);

        $name = new User();
        $name->id = 3;
        $name->name = 'sergio';
        $name->email = 'sergiogustavo.saldana@gmail.com';
        $name->password =  Hash::make('sergio2021');
        $name->save();
        $name->roles()->attach(3, ['app' => 1]);

        $name = new User();
        $name->id = 4;
        $name->name = 'pablo';
        $name->email = 'pablo.suarez125@gmail.com';
        $name->password =  Hash::make('pablo2021');
        $name->save();
        $name->roles()->attach(3, ['app' => 1]);

        $name = new User();
        $name->id = 5;
        $name->name = 'dindio';
        $name->email = 'marcelodcfierios@gmail.com';
        $name->password =  Hash::make('dindio2021');
        $name->save();
        $name->roles()->attach(3, ['app' => 1]);

        $name = new User();
        $name->id = 6;
        $name->name = 'luciano';
        $name->email = 'lucianofgcfierios@gmail.com';
        $name->password =  Hash::make('luciano2021');
        $name->save();
        $name->roles()->attach(3, ['app' => 1]);
        $name = new User();

        $name->id = 7;
        $name->name = 'facundo';
        $name->email = 'facundolarrosacfi@gmail.com';
        $name->password =  Hash::make('facundo2021');
        $name->save();
        $name->roles()->attach(3, ['app' => 1]);

    }
}
