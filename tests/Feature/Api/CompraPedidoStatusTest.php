<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\CompraPedidoStatus;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompraPedidoStatusTest extends TestCase
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
    public function it_gets_compra_pedido_statuses_list()
    {
        $compraPedidoStatuses = CompraPedidoStatus::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.compra-pedido-statuses.index'));

        $response->assertOk()->assertSee($compraPedidoStatuses[0]->descricao);
    }

    /**
     * @test
     */
    public function it_stores_the_compra_pedido_status()
    {
        $data = CompraPedidoStatus::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.compra-pedido-statuses.store'),
            $data
        );

        $this->assertDatabaseHas('compra_pedido_statuses', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.compra-pedido-statuses.update', $compraPedidoStatus),
            $data
        );

        $data['id'] = $compraPedidoStatus->id;

        $this->assertDatabaseHas('compra_pedido_statuses', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_compra_pedido_status()
    {
        $compraPedidoStatus = CompraPedidoStatus::factory()->create();

        $response = $this->deleteJson(
            route('api.compra-pedido-statuses.destroy', $compraPedidoStatus)
        );

        $this->assertSoftDeleted($compraPedidoStatus);

        $response->assertNoContent();
    }
}
