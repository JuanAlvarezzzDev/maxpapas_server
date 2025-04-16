<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmpaqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('empaques')->insert([
            'nombre' =>  "Sin Empaque",
            'precio' => 0,
            'imagen' => "Sin_Empaque",
            'disponible' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        DB::table('empaques')->insert([
            'nombre' =>  "Empaque Pequeño",
            'precio' => 500,
            'imagen' => "Empaque_Pequeño",
            'disponible' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('empaques')->insert([
            'nombre' =>  "Empaque Mediano",
            'precio' => 1000,
            'imagen' => "Empaque_Mediano",
            'disponible' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('empaques')->insert([
            'nombre' =>  "Empaque Grande",
            'precio' => 2000,
            'imagen' => "Empaque_Grande",
            'disponible' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
