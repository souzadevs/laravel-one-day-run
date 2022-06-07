<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use App\Models\CompraPedido;
use App\Models\CompraPedidoItem;
use App\Http\Requests\CompraPedidoItemStoreRequest;
use App\Http\Requests\CompraPedidoItemUpdateRequest;
use App\Services\CompraPedidoItemService;

class CompraPedidoItemController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', CompraPedidoItem::class);

        $search = $request->get('search', '');

        $compraPedidoItems = CompraPedidoItem::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.compra_pedido_items.index',
            compact('compraPedidoItems', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', CompraPedidoItem::class);

        $produtos = Produto::pluck('codigo_barras', 'id');
        $compraPedidos = CompraPedido::pluck('id', 'id');

        return view(
            'app.compra_pedido_items.create',
            compact('produtos', 'compraPedidos')
        );
    }

    /**
     * @param \App\Http\Requests\CompraPedidoItemStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompraPedidoItemStoreRequest $request)
    {
        $this->authorize('create', CompraPedidoItem::class);

        $validated = $request->validated();

        $compraPedidoItem = CompraPedidoItem::create($validated);

        return redirect()
            ->route('compra-pedido-items.edit', $compraPedidoItem)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CompraPedidoItem $compraPedidoItem
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, CompraPedidoItem $compraPedidoItem)
    {
        $this->authorize('view', $compraPedidoItem);

        return view(
            'app.compra_pedido_items.show',
            compact('compraPedidoItem')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CompraPedidoItem $compraPedidoItem
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, CompraPedidoItem $compraPedidoItem)
    {
        $this->authorize('update', $compraPedidoItem);

        $produtos = Produto::pluck('codigo_barras', 'id');
        $compraPedidos = CompraPedido::pluck('id', 'id');

        return view(
            'app.compra_pedido_items.edit',
            compact('compraPedidoItem', 'produtos', 'compraPedidos')
        );
    }

    /**
     * @param \App\Http\Requests\CompraPedidoItemUpdateRequest $request
     * @param \App\Models\CompraPedidoItem $compraPedidoItem
     * @return \Illuminate\Http\Response
     */
    public function update(
        CompraPedidoItemUpdateRequest $request,
        CompraPedidoItem $compraPedidoItem
    ) {
        $this->authorize('update', $compraPedidoItem);

        $validated = $request->validated();

        $compraPedidoItem->update($validated);

        return redirect()
            ->route('compra-pedido-items.edit', $compraPedidoItem)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CompraPedidoItem $compraPedidoItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request $request,
        CompraPedidoItem $compraPedidoItem
    ) {
        $this->authorize('delete', $compraPedidoItem);

        $compraPedidoItem->delete();

        return redirect()
            ->route('compra-pedido-items.index')
            ->withSuccess(__('crud.common.removed'));
    }
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CompraPedidoItem $compraPedidoItem
     * @return \Illuminate\Http\Response
     */
    public function delete(
        Request $request
    ) {
        $item = CompraPedidoItem::find($request->id);
        $item->delete();
    }

    /**
     * Return the dimensioned data to datatable
     * 
     * @param \Illuminate\Http\Request $request
     * @return @return \Illuminate\Http\Response
     */
    public function getCompraPedidosItensToDatatable(Request $request, CompraPedidoItemService $compraPedidoItemService)
    {
        return $compraPedidoItemService->getCompraPedidosItensToDatatable($request);
    }
}
