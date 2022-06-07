<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Produto;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProdutoTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_produtos_list()
    {
        $produtos = Produto::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.produtos.index'));

        $response->assertOk()->assertSee($produtos[0]->codigo_barras);
    }

    /**
     * @test
     */
    public function it_stores_the_produto()
    {
        $data = Produto::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.produtos.store'), $data);

        $this->assertDatabaseHas('produtos', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_produto()
    {
        $produto = Produto::factory()->create();

        $data = [
            'valor_unitario' => $this->faker->randomNumber(2),
            'codigo_barras' => $this->faker->unique->text(20),
            'nome' => $this->faker->unique->text(100),
        ];

        $response = $this->putJson(
            route('api.produtos.update', $produto),
            $data
        );

        $data['id'] = $produto->id;

        $this->assertDatabaseHas('produtos', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_produto()
    {
        $produto = Produto::factory()->create();

        $response = $this->deleteJson(route('api.produtos.destroy', $produto));

        $this->assertSoftDeleted($produto);

        $response->assertNoContent();
    }
}
