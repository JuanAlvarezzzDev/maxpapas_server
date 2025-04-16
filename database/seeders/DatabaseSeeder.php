<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call(StatePedidoSeeder::class);
        $this->call(PaymentPedidoSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(EmpaqueSeeder::class);
        $this->call(CardProductSeeder::class);
        $this->call(ProductoSeeder::class);
        $this->call(CoinSeeder::class);
    }
}
