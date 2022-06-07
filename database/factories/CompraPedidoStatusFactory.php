<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\CompraPedidoStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompraPedidoStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CompraPedidoStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'descricao'     => $this->faker->text(255),
            'cor_fundo_hex' => $this->faker->text(255),
            'cor_texto_hex' => $this->faker->text(255),
        ];
    }
}
