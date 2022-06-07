<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\CompraPedidoStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\CompraPedidoStatusResource;
use App\Http\Resources\CompraPedidoStatusCollection;
use App\Http\Requests\CompraPedidoStatusStoreRequest;
use App\Http\Requests\CompraPedidoStatusUpdateRequest;

class CompraPedidoStatusController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', CompraPedidoStatus::class);

        $search = $request->get('search', '');

        $compraPedidoStatuses = CompraPedidoStatus::search($search)
            ->latest()
            ->paginate();

        return new CompraPedidoStatusCollection($compraPedidoStatuses);
    }

    /**
     * @param \App\Http\Requests\CompraPedidoStatusStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompraPedidoStatusStoreRequest $request)
    {
        $this->authorize('create', CompraPedidoStatus::class);

        $validated = $request->validated();

        $compraPedidoStatus = CompraPedidoStatus::create($validated);

        return new CompraPedidoStatusResource($compraPedidoStatus);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CompraPedidoStatus $compraPedidoStatus
     * @return \Illuminate\Http\Response
     */
    public function show(
        Request $request,
        CompraPedidoStatus $compraPedidoStatus
    ) {
        $this->authorize('view', $compraPedidoStatus);

        return new CompraPedidoStatusResource($compraPedidoStatus);
    }

    /**
     * @param \App\Http\Requests\CompraPedidoStatusUpdateRequest $request
     * @param \App\Models\CompraPedidoStatus $compraPedidoStatus
     * @return \Illuminate\Http\Response
     */
    public function update(
        CompraPedidoStatusUpdateRequest $request,
        CompraPedidoStatus $compraPedidoStatus
    ) {
        $this->authorize('update', $compraPedidoStatus);

        $validated = $request->validated();

        $compraPedidoStatus->update($validated);

        return new CompraPedidoStatusResource($compraPedidoStatus);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CompraPedidoStatus $compraPedidoStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request $request,
        CompraPedidoStatus $compraPedidoStatus
    ) {
        $this->authorize('delete', $compraPedidoStatus);

        $compraPedidoStatus->delete();

        return response()->noContent();
    }
}
