<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\CompraPedido;
use App\Models\CompraPedidoItem;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompraPedidoCompraPedidoItemsTest extends TestCase
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
    public function it_gets_compra_pedido_compra_pedido_items()
    {
        $compraPedido = CompraPedido::factory()->create();
        $compraPedidoItems = CompraPedidoItem::factory()
            ->count(2)
            ->create([
                'compra_pedido_id' => $compraPedido->id,
            ]);

        $response = $this->getJson(
            route('api.compra-pedidos.compra-pedido-items.index', $compraPedido)
        );

        $response->assertOk()->assertSee($compraPedidoItems[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_compra_pedido_compra_pedido_items()
    {
        $compraPedido = CompraPedido::factory()->create();
        $data = CompraPedidoItem::factory()
            ->make([
                'compra_pedido_id' => $compraPedido->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.compra-pedidos.compra-pedido-items.store',
                $compraPedido
            ),
            $data
        );

        $this->assertDatabaseHas('compra_pedido_items', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $compraPedidoItem = CompraPedidoItem::latest('id')->first();

        $this->assertEquals(
            $compraPedido->id,
            $compraPedidoItem->compra_pedido_id
        );
    }
}
