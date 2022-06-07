<?php

namespace Database\Seeders;

use App\Models\CompraPedido;
use Illuminate\Database\Seeder;

class CompraPedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CompraPedido::factory()
            ->count(5)
            ->create();
    }
}
