<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompraPedidoStatus;

class CompraPedidoStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // CompraPedidoStatus::factory()
        //     ->count(3)
        //     ->create();

        $status = CompraPedidoStatus::create([
            'descricao' => 'Aberto',
            'cor_fundo_hex' => '#fafafa',
            'cor_texto_hex' => '#202020',
        ]);

        $status->save();
        $status = CompraPedidoStatus::create([
            'descricao' => 'Pago',
            'cor_fundo_hex' => '#fafafa',
            'cor_texto_hex' => '#202020',
        ]);

        $status->save();
        $status = CompraPedidoStatus::create([
            'descricao' => 'Cancelado',
            'cor_fundo_hex' => '#fafafa',
            'cor_texto_hex' => '#202020',
        ]);

        $status->save();


    }
}
