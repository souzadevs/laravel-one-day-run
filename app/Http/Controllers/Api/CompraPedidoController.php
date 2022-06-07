<?php

namespace App\Http\Controllers\Api;

use App\Models\CompraPedido;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CompraPedidoResource;
use App\Http\Resources\CompraPedidoCollection;
use App\Http\Requests\CompraPedidoStoreRequest;
use App\Http\Requests\CompraPedidoUpdateRequest;

class CompraPedidoController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', CompraPedido::class);

        $search = $request->get('search', '');

        $compraPedidos = CompraPedido::search($search)
            ->latest()
            ->paginate();

        return new CompraPedidoCollection($compraPedidos);
    }

    /**
     * @param \App\Http\Requests\CompraPedidoStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompraPedidoStoreRequest $request)
    {
        $this->authorize('create', CompraPedido::class);

        $validated = $request->validated();

        $compraPedido = CompraPedido::create($validated);

        return new CompraPedidoResource($compraPedido);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CompraPedido $compraPedido
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, CompraPedido $compraPedido)
    {
        $this->authorize('view', $compraPedido);

        return new CompraPedidoResource($compraPedido);
    }

    /**
     * @param \App\Http\Requests\CompraPedidoUpdateRequest $request
     * @param \App\Models\CompraPedido $compraPedido
     * @return \Illuminate\Http\Response
     */
    public function update(
        CompraPedidoUpdateRequest $request,
        CompraPedido $compraPedido
    ) {
        $this->authorize('update', $compraPedido);

        $validated = $request->validated();

        $compraPedido->update($validated);

        return new CompraPedidoResource($compraPedido);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CompraPedido $compraPedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, CompraPedido $compraPedido)
    {
        $this->authorize('delete', $compraPedido);

        $compraPedido->delete();

        return response()->noContent();
    }
}
