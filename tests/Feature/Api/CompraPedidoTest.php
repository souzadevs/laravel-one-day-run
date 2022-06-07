<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\CompraPedido;

use App\Models\Cliente;
use App\Models\CompraPedidoStatus;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompraPedidoTest extends TestCase
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
    public function it_gets_compra_pedidos_list()
    {
        $compraPedidos = CompraPedido::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.compra-pedidos.index'));

        $response->assertOk()->assertSee($compraPedidos[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_compra_pedido()
    {
        $data = CompraPedido::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.compra-pedidos.store'), $data);

        unset($data['numero_pedido']);

        $this->assertDatabaseHas('compra_pedidos', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_compra_pedido()
    {
        $compraPedido = CompraPedido::factory()->create();

        $cliente = Cliente::factory()->create();
        $compraPedidoStatus = CompraPedidoStatus::factory()->create();

        $data = [
            'numero_pedido' => $this->faker->randomNumber(0),
            'pedido_at' => $this->faker->dateTime,
            'cliente_id' => $cliente->id,
            'compra_pedido_status_id' => $compraPedidoStatus->id,
        ];

        $response = $this->putJson(
            route('api.compra-pedidos.update', $compraPedido),
            $data
        );

        unset($data['numero_pedido']);

        $data['id'] = $compraPedido->id;

        $this->assertDatabaseHas('compra_pedidos', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_compra_pedido()
    {
        $compraPedido = CompraPedido::factory()->create();

        $response = $this->deleteJson(
            route('api.compra-pedidos.destroy', $compraPedido)
        );

        $this->assertSoftDeleted($compraPedido);

        $response->assertNoContent();
    }
}
