<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\CompraPedido;
use App\Models\CompraPedidoStatus;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompraPedidoStatusCompraPedidosTest extends TestCase
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
    public function it_gets_compra_pedido_status_compra_pedidos()
    {
        $compraPedidoStatus = CompraPedidoStatus::factory()->create();
        $compraPedidos = CompraPedido::factory()
            ->count(2)
            ->create([
                'compra_pedido_status_id' => $compraPedidoStatus->id,
            ]);

        $response = $this->getJson(
            route(
                'api.compra-pedido-statuses.compra-pedidos.index',
                $compraPedidoStatus
            )
        );

        $response->assertOk()->assertSee($compraPedidos[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_compra_pedido_status_compra_pedidos()
    {
        $compraPedidoStatus = CompraPedidoStatus::factory()->create();
        $data = CompraPedido::factory()
            ->make([
                'compra_pedido_status_id' => $compraPedidoStatus->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.compra-pedido-statuses.compra-pedidos.store',
                $compraPedidoStatus
            ),
            $data
        );

        unset($data['numero_pedido']);

        $this->assertDatabaseHas('compra_pedidos', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $compraPedido = CompraPedido::latest('id')->first();

        $this->assertEquals(
            $compraPedidoStatus->id,
            $compraPedido->compra_pedido_status_id
        );
    }
}
