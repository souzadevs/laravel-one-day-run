<?php

namespace App\Http\Controllers\Api;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CompraPedidoResource;
use App\Http\Resources\CompraPedidoCollection;

class ClienteCompraPedidosController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Cliente $cliente)
    {
        $this->authorize('view', $cliente);

        $search = $request->get('search', '');

        $compraPedidos = $cliente
            ->compraPedidos()
            ->search($search)
            ->latest()
            ->paginate();

        return new CompraPedidoCollection($compraPedidos);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Cliente $cliente)
    {
        $this->authorize('create', CompraPedido::class);

        $validated = $request->validate([
            'pedido_at' => ['required', 'date'],
            'compra_pedido_status_id' => [
                'required',
                'exists:compra_pedido_statuses,id',
            ],
        ]);

        $compraPedido = $cliente->compraPedidos()->create($validated);

        return new CompraPedidoResource($compraPedido);
    }
}
