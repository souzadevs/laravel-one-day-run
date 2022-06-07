<?php

namespace App\Http\Controllers\Api;

use App\Models\CompraPedido;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CompraPedidoItemResource;
use App\Http\Resources\CompraPedidoItemCollection;

class CompraPedidoCompraPedidoItemsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CompraPedido $compraPedido
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, CompraPedido $compraPedido)
    {
        $this->authorize('view', $compraPedido);

        $search = $request->get('search', '');

        $compraPedidoItems = $compraPedido
            ->compraPedidoItems()
            ->search($search)
            ->latest()
            ->paginate();

        return new CompraPedidoItemCollection($compraPedidoItems);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CompraPedido $compraPedido
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CompraPedido $compraPedido)
    {
        $this->authorize('create', CompraPedidoItem::class);

        $validated = $request->validate([
            'quantidade' => ['required', 'numeric'],
            'produto_id' => ['required', 'exists:produtos,id'],
        ]);

        $compraPedidoItem = $compraPedido
            ->compraPedidoItems()
            ->create($validated);

        return new CompraPedidoItemResource($compraPedidoItem);
    }
}
