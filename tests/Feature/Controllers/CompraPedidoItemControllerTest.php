<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\CompraPedidoItem;

use App\Models\Produto;
use App\Models\CompraPedido;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompraPedidoItemControllerTest extends TestCase
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
    public function it_displays_index_view_with_compra_pedido_items()
    {
        $compraPedidoItems = CompraPedidoItem::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('compra-pedido-items.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.compra_pedido_items.index')
            ->assertViewHas('compraPedidoItems');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_compra_pedido_item()
    {
        $response = $this->get(route('compra-pedido-items.create'));

        $response->assertOk()->assertViewIs('app.compra_pedido_items.create');
    }

    /**
     * @test
     */
    public function it_stores_the_compra_pedido_item()
    {
        $data = CompraPedidoItem::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('compra-pedido-items.store'), $data);

        $this->assertDatabaseHas('compra_pedido_items', $data);

        $compraPedidoItem = CompraPedidoItem::latest('id')->first();

        $response->assertRedirect(
            route('compra-pedido-items.edit', $compraPedidoItem)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_compra_pedido_item()
    {
        $compraPedidoItem = CompraPedidoItem::factory()->create();

        $response = $this->get(
            route('compra-pedido-items.show', $compraPedidoItem)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.compra_pedido_items.show')
            ->assertViewHas('compraPedidoItem');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_compra_pedido_item()
    {
        $compraPedidoItem = CompraPedidoItem::factory()->create();

        $response = $this->get(
            route('compra-pedido-items.edit', $compraPedidoItem)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.compra_pedido_items.edit')
            ->assertViewHas('compraPedidoItem');
    }

    /**
     * @test
     */
    public function it_updates_the_compra_pedido_item()
    {
        $compraPedidoItem = CompraPedidoItem::factory()->create();

        $produto = Produto::factory()->create();
        $compraPedido = CompraPedido::factory()->create();

        $data = [
            'quantidade' => $this->faker->randomNumber(0),
            'produto_id' => $produto->id,
            'compra_pedido_id' => $compraPedido->id,
        ];

        $response = $this->put(
            route('compra-pedido-items.update', $compraPedidoItem),
            $data
        );

        $data['id'] = $compraPedidoItem->id;

        $this->assertDatabaseHas('compra_pedido_items', $data);

        $response->assertRedirect(
            route('compra-pedido-items.edit', $compraPedidoItem)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_compra_pedido_item()
    {
        $compraPedidoItem = CompraPedidoItem::factory()->create();

        $response = $this->delete(
            route('compra-pedido-items.destroy', $compraPedidoItem)
        );

        $response->assertRedirect(route('compra-pedido-items.index'));

        $this->assertSoftDeleted($compraPedidoItem);
    }
}
