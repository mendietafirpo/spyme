<?php

namespace Database\Seeders;
use App\Models\Dfmoney;

use Illuminate\Database\Seeder;

class DfmoneySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $money = new Dfmoney();
        $money->id = 1;
        $money->money = '$ARS';
        $money->descripcion = 'Peso Argentino';
        $money->save();
        $money = new Dfmoney();
        $money->id = 2;
        $money->money = 'USD';
        $money->descripcion = 'Dolar Americano';
        $money->save();
        $money = new Dfmoney();
        $money->id = 3;
        $money->money = 'R$';
        $money->descripcion = 'Real Brasilero';
        $money->save();
        $money = new Dfmoney();
        $money->id = 4;
        $money->money = 'B$';
        $money->descripcion = 'Bolivar Bolivino';
        $money->save();
        $money = new Dfmoney();
        $money->id = 5;
        $money->money = '$CLP';
        $money->descripcion = 'Peso Chileno';
        $money->save();
        $money = new Dfmoney();
        $money->id = 6;
        $money->money = '$COP';
        $money->descripcion = 'Peso Colombiano';
        $money->save();
        $money = new Dfmoney();
        $money->id = 7;
        $money->money = 'EUR';
        $money->descripcion = 'Euro';
        $money->save();
        $money = new Dfmoney();
        $money->id = 8;
        $money->money = 'AUD';
        $money->descripcion = 'Dolar Australiano';
        $money->save();
        $money = new Dfmoney();
        $money->id = 9;
        $money->money = 'B$';
        $money->descripcion = 'Bolivar Venezolano';
        $money->save();
    }
}
