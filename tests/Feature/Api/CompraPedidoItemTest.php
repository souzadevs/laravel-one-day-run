<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\CompraPedidoItem;

use App\Models\Produto;
use App\Models\CompraPedido;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompraPedidoItemTest extends TestCase
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
    public function it_gets_compra_pedido_items_list()
    {
        $compraPedidoItems = CompraPedidoItem::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.compra-pedido-items.index'));

        $response->assertOk()->assertSee($compraPedidoItems[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_compra_pedido_item()
    {
        $data = CompraPedidoItem::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.compra-pedido-items.store'),
            $data
        );

        $this->assertDatabaseHas('compra_pedido_items', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.compra-pedido-items.update', $compraPedidoItem),
            $data
        );

        $data['id'] = $compraPedidoItem->id;

        $this->assertDatabaseHas('compra_pedido_items', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_compra_pedido_item()
    {
        $compraPedidoItem = CompraPedidoItem::factory()->create();

        $response = $this->deleteJson(
            route('api.compra-pedido-items.destroy', $compraPedidoItem)
        );

        $this->assertSoftDeleted($compraPedidoItem);

        $response->assertNoContent();
    }
}
