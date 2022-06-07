<?php

namespace Database\Factories;

use App\Models\Produto;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdutoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Produto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'valor_unitario' => $this->faker->randomFloat(2,0,999),
            'codigo_barras' => $this->faker->unique->randomNumber(7),
            'nome' => $this->faker->unique->text(20),
        ];
    }
}
