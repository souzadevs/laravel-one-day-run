<?php

namespace App\Http\Controllers\Api;

use App\Models\Produto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CompraPedidoItemResource;
use App\Http\Resources\CompraPedidoItemCollection;

class ProdutoCompraPedidoItemsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Produto $produto
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Produto $produto)
    {
        $this->authorize('view', $produto);

        $search = $request->get('search', '');

        $compraPedidoItems = $produto
            ->compraItems()
            ->search($search)
            ->latest()
            ->paginate();

        return new CompraPedidoItemCollection($compraPedidoItems);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Produto $produto
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Produto $produto)
    {
        $this->authorize('create', CompraPedidoItem::class);

        $validated = $request->validate([
            'quantidade' => ['required', 'numeric'],
            'compra_pedido_id' => ['required', 'exists:compra_pedidos,id'],
        ]);

        $compraPedidoItem = $produto->compraItems()->create($validated);

        return new CompraPedidoItemResource($compraPedidoItem);
    }
}
