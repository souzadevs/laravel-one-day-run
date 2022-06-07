<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\CompraPedidoItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompraPedidoItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CompraPedidoItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'quantidade' => $this->faker->randomNumber(0),
            'produto_id' => \App\Models\Produto::factory(),
            'compra_pedido_id' => \App\Models\CompraPedido::factory(),
        ];
    }
}
