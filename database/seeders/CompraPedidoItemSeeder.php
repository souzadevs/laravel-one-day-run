<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompraPedidoItem;

class CompraPedidoItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CompraPedidoItem::factory()
            ->count(5)
            ->create();
    }
}
