<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Produto;
use App\Models\CompraPedidoItem;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProdutoCompraPedidoItemsTest extends TestCase
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
    public function it_gets_produto_compra_pedido_items()
    {
        $produto = Produto::factory()->create();
        $compraPedidoItems = CompraPedidoItem::factory()
            ->count(2)
            ->create([
                'produto_id' => $produto->id,
            ]);

        $response = $this->getJson(
            route('api.produtos.compra-pedido-items.index', $produto)
        );

        $response->assertOk()->assertSee($compraPedidoItems[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_produto_compra_pedido_items()
    {
        $produto = Produto::factory()->create();
        $data = CompraPedidoItem::factory()
            ->make([
                'produto_id' => $produto->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.produtos.compra-pedido-items.store', $produto),
            $data
        );

        $this->assertDatabaseHas('compra_pedido_items', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $compraPedidoItem = CompraPedidoItem::latest('id')->first();

        $this->assertEquals($produto->id, $compraPedidoItem->produto_id);
    }
}
