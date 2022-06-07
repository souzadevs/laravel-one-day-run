<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\CompraPedido;

use App\Models\Cliente;
use App\Models\CompraPedidoStatus;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompraPedidoControllerTest extends TestCase
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
    public function it_displays_index_view_with_compra_pedidos()
    {
        $compraPedidos = CompraPedido::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('compra-pedidos.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.compra_pedidos.index')
            ->assertViewHas('compraPedidos');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_compra_pedido()
    {
        $response = $this->get(route('compra-pedidos.create'));

        $response->assertOk()->assertViewIs('app.compra_pedidos.create');
    }

    /**
     * @test
     */
    public function it_stores_the_compra_pedido()
    {
        $data = CompraPedido::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('compra-pedidos.store'), $data);

        unset($data['numero_pedido']);

        $this->assertDatabaseHas('compra_pedidos', $data);

        $compraPedido = CompraPedido::latest('id')->first();

        $response->assertRedirect(route('compra-pedidos.edit', $compraPedido));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_compra_pedido()
    {
        $compraPedido = CompraPedido::factory()->create();

        $response = $this->get(route('compra-pedidos.show', $compraPedido));

        $response
            ->assertOk()
            ->assertViewIs('app.compra_pedidos.show')
            ->assertViewHas('compraPedido');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_compra_pedido()
    {
        $compraPedido = CompraPedido::factory()->create();

        $response = $this->get(route('compra-pedidos.edit', $compraPedido));

        $response
            ->assertOk()
            ->assertViewIs('app.compra_pedidos.edit')
            ->assertViewHas('compraPedido');
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

        $response = $this->put(
            route('compra-pedidos.update', $compraPedido),
            $data
        );

        unset($data['numero_pedido']);

        $data['id'] = $compraPedido->id;

        $this->assertDatabaseHas('compra_pedidos', $data);

        $response->assertRedirect(route('compra-pedidos.edit', $compraPedido));
    }

    /**
     * @test
     */
    public function it_deletes_the_compra_pedido()
    {
        $compraPedido = CompraPedido::factory()->create();

        $response = $this->delete(
            route('compra-pedidos.destroy', $compraPedido)
        );

        $response->assertRedirect(route('compra-pedidos.index'));

        $this->assertSoftDeleted($compraPedido);
    }
}
