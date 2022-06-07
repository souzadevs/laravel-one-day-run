<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\CompraPedidoStatus;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompraPedidoStatusControllerTest extends TestCase
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
    public function it_displays_index_view_with_compra_pedido_statuses()
    {
        $compraPedidoStatuses = CompraPedidoStatus::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('compra-pedido-statuses.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.compra_pedido_statuses.index')
            ->assertViewHas('compraPedidoStatuses');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_compra_pedido_status()
    {
        $response = $this->get(route('compra-pedido-statuses.create'));

        $response
            ->assertOk()
            ->assertViewIs('app.compra_pedido_statuses.create');
    }

    /**
     * @test
     */
    public function it_stores_the_compra_pedido_status()
    {
        $data = CompraPedidoStatus::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('compra-pedido-statuses.store'), $data);

        $this->assertDatabaseHas('compra_pedido_statuses', $data);

        $compraPedidoStatus = CompraPedidoStatus::latest('id')->first();

        $response->assertRedirect(
            route('compra-pedido-statuses.edit', $compraPedidoStatus)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_compra_pedido_status()
    {
        $compraPedidoStatus = CompraPedidoStatus::factory()->create();

        $response = $this->get(
            route('compra-pedido-statuses.show', $compraPedidoStatus)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.compra_pedido_statuses.show')
            ->assertViewHas('compraPedidoStatus');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_compra_pedido_status()
    {
        $compraPedidoStatus = CompraPedidoStatus::factory()->create();

        $response = $this->get(
            route('compra-pedido-statuses.edit', $compraPedidoStatus)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.compra_pedido_statuses.edit')
            ->assertViewHas('compraPedidoStatus');
    }

    /**
     * @test
     */
    public function it_updates_the_compra_pedido_status()
    {
        $compraPedidoStatus = CompraPedidoStatus::factory()->create();

        $data = [
            'descricao' => $this->faker->text(255),
            'cor_fundo_hex' => $this->faker->text(255),
            'cor_texto_hex' => $this->faker->text(255),
        ];

        $response = $this->put(
            route('compra-pedido-statuses.update', $compraPedidoStatus),
            $data
        );

        $data['id'] = $compraPedidoStatus->id;

        $this->assertDatabaseHas('compra_pedido_statuses', $data);

        $response->assertRedirect(
            route('compra-pedido-statuses.edit', $compraPedidoStatus)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_compra_pedido_status()
    {
        $compraPedidoStatus = CompraPedidoStatus::factory()->create();

        $response = $this->delete(
            route('compra-pedido-statuses.destroy', $compraPedidoStatus)
        );

        $response->assertRedirect(route('compra-pedido-statuses.index'));

        $this->assertSoftDeleted($compraPedidoStatus);
    }
}
