<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\CompraPedido;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompraPedidoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CompraPedido::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'pedido_at' => $this->faker->dateTime,
            'cliente_id' => \App\Models\Cliente::factory(),
            'compra_pedido_status_id' => $this->faker->numberBetween(1,3),
        ];
    }
}
