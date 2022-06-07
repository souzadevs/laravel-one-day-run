<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\CompraPedidoItem;
use App\Http\Controllers\Controller;
use App\Http\Resources\CompraPedidoItemResource;
use App\Http\Resources\CompraPedidoItemCollection;
use App\Http\Requests\CompraPedidoItemStoreRequest;
use App\Http\Requests\CompraPedidoItemUpdateRequest;

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
            ->paginate();

        return new CompraPedidoItemCollection($compraPedidoItems);
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

        return new CompraPedidoItemResource($compraPedidoItem);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CompraPedidoItem $compraPedidoItem
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, CompraPedidoItem $compraPedidoItem)
    {
        $this->authorize('view', $compraPedidoItem);

        return new CompraPedidoItemResource($compraPedidoItem);
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

        return new CompraPedidoItemResource($compraPedidoItem);
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

        return response()->noContent();
    }
}
