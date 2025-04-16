<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coins')->insert([
            'nombre' =>  "Dos Mil",
            'precio' => 2000,
            'imagen' => "Bill_2mil",
            'disponible' => true,
            'es_moneda' => false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('coins')->insert([
            'nombre' =>  "Cinco Mil",
            'precio' => 5000,
            'imagen' => "Bill_5mil",
            'disponible' => true,
            'es_moneda' => false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('coins')->insert([
            'nombre' =>  "Diez Mil",
            'precio' => 10000,
            'imagen' => "Bill_10mil",
            'disponible' => true,
            'es_moneda' => false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('coins')->insert([
            'nombre' =>  "VeinteMil",
            'precio' => 20000,
            'imagen' => "Bill_20mil",
            'disponible' => true,
            'es_moneda' => false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('coins')->insert([
            'nombre' =>  "Cincuenta Mil",
            'precio' => 50000,
            'imagen' => "Bill_50mil",
            'disponible' => true,
            'es_moneda' => false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('coins')->insert([
            'nombre' =>  "Cien Mil",
            'precio' => 100000,
            'imagen' => "Bill_100mil",
            'disponible' => true,
            'es_moneda' => false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('coins')->insert([
            'nombre' =>  "50 Pesos",
            'precio' => 50,
            'imagen' => "moneda_50pesos",
            'disponible' => true,
            'es_moneda' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('coins')->insert([
            'nombre' =>  "100 Pesos",
            'precio' => 100,
            'imagen' => "moneda_100pesos",
            'disponible' => true,
            'es_moneda' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('coins')->insert([
            'nombre' =>  "200 Pesos",
            'precio' => 200,
            'imagen' => "moneda_200pesos",
            'disponible' => true,
            'es_moneda' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('coins')->insert([
            'nombre' =>  "500 Pesos",
            'precio' => 500,
            'imagen' => "moneda_500pesos",
            'disponible' => true,
            'es_moneda' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('coins')->insert([
            'nombre' =>  "1000 Pesos",
            'precio' => 1000,
            'imagen' => "moneda_1000pesos",
            'disponible' => true,
            'es_moneda' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
