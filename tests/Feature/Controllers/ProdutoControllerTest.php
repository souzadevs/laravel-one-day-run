<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Produto;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProdutoControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_produtos()
    {
        $produtos = Produto::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('produtos.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.produtos.index')
            ->assertViewHas('produtos');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_produto()
    {
        $response = $this->get(route('produtos.create'));

        $response->assertOk()->assertViewIs('app.produtos.create');
    }

    /**
     * @test
     */
    public function it_stores_the_produto()
    {
        $data = Produto::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('produtos.store'), $data);

        $this->assertDatabaseHas('produtos', $data);

        $produto = Produto::latest('id')->first();

        $response->assertRedirect(route('produtos.edit', $produto));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_produto()
    {
        $produto = Produto::factory()->create();

        $response = $this->get(route('produtos.show', $produto));

        $response
            ->assertOk()
            ->assertViewIs('app.produtos.show')
            ->assertViewHas('produto');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_produto()
    {
        $produto = Produto::factory()->create();

        $response = $this->get(route('produtos.edit', $produto));

        $response
            ->assertOk()
            ->assertViewIs('app.produtos.edit')
            ->assertViewHas('produto');
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

        $response = $this->put(route('produtos.update', $produto), $data);

        $data['id'] = $produto->id;

        $this->assertDatabaseHas('produtos', $data);

        $response->assertRedirect(route('produtos.edit', $produto));
    }

    /**
     * @test
     */
    public function it_deletes_the_produto()
    {
        $produto = Produto::factory()->create();

        $response = $this->delete(route('produtos.destroy', $produto));

        $response->assertRedirect(route('produtos.index'));

        $this->assertSoftDeleted($produto);
    }
}
