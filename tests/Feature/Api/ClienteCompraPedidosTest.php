<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Cliente;
use App\Models\CompraPedido;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClienteCompraPedidosTest extends TestCase
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
    public function it_gets_cliente_compra_pedidos()
    {
        $cliente = Cliente::factory()->create();
        $compraPedidos = CompraPedido::factory()
            ->count(2)
            ->create([
                'cliente_id' => $cliente->id,
            ]);

        $response = $this->getJson(
            route('api.clientes.compra-pedidos.index', $cliente)
        );

        $response->assertOk()->assertSee($compraPedidos[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_cliente_compra_pedidos()
    {
        $cliente = Cliente::factory()->create();
        $data = CompraPedido::factory()
            ->make([
                'cliente_id' => $cliente->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.clientes.compra-pedidos.store', $cliente),
            $data
        );

        unset($data['numero_pedido']);

        $this->assertDatabaseHas('compra_pedidos', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $compraPedido = CompraPedido::latest('id')->first();

        $this->assertEquals($cliente->id, $compraPedido->cliente_id);
    }
}
