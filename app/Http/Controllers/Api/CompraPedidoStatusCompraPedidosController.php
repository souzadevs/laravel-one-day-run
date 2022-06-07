<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\CompraPedidoStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\CompraPedidoResource;
use App\Http\Resources\CompraPedidoCollection;

class CompraPedidoStatusCompraPedidosController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CompraPedidoStatus $compraPedidoStatus
     * @return \Illuminate\Http\Response
     */
    public function index(
        Request $request,
        CompraPedidoStatus $compraPedidoStatus
    ) {
        $this->authorize('view', $compraPedidoStatus);

        $search = $request->get('search', '');

        $compraPedidos = $compraPedidoStatus
            ->compraPedidos()
            ->search($search)
            ->latest()
            ->paginate();

        return new CompraPedidoCollection($compraPedidos);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CompraPedidoStatus $compraPedidoStatus
     * @return \Illuminate\Http\Response
     */
    public function store(
        Request $request,
        CompraPedidoStatus $compraPedidoStatus
    ) {
        $this->authorize('create', CompraPedido::class);

        $validated = $request->validate([
            'pedido_at' => ['required', 'date'],
            'cliente_id' => ['required', 'exists:clientes,id'],
        ]);

        $compraPedido = $compraPedidoStatus
            ->compraPedidos()
            ->create($validated);

        return new CompraPedidoResource($compraPedido);
    }
}
