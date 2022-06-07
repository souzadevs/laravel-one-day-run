<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompraPedidoStatus;
use App\Http\Requests\CompraPedidoStatusStoreRequest;
use App\Http\Requests\CompraPedidoStatusUpdateRequest;
use App\Services\CompraPedidoStatusService;

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
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.compra_pedido_statuses.index',
            compact('compraPedidoStatuses', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', CompraPedidoStatus::class);

        return view('app.compra_pedido_statuses.create');
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

        return redirect()
            ->route('compra-pedido-statuses.edit', $compraPedidoStatus)
            ->withSuccess(__('crud.common.created'));
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

        return view(
            'app.compra_pedido_statuses.show',
            compact('compraPedidoStatus')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CompraPedidoStatus $compraPedidoStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(
        Request $request,
        CompraPedidoStatus $compraPedidoStatus
    ) {
        $this->authorize('update', $compraPedidoStatus);

        return view(
            'app.compra_pedido_statuses.edit',
            compact('compraPedidoStatus')
        );
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

        return redirect()
            ->route('compra-pedido-statuses.edit', $compraPedidoStatus)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('compra-pedido-statuses.index')
            ->withSuccess(__('crud.common.removed'));
    }

    /**
     * Return the dimensioned data to datatable
     * 
     * @param \Illuminate\Http\Request $request
     * @return @return \Illuminate\Http\Response
     */
    public function getCompraPedidoStatusToDatatable(Request $request, CompraPedidoStatusService $compraPedidoStatusService)
    {
        return $compraPedidoStatusService->getCompraPedidoStatusToDatatable($request);
    }
}
