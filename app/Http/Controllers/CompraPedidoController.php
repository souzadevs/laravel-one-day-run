<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\CompraPedido;
use Illuminate\Http\Request;
use App\Models\CompraPedidoStatus;
use App\Http\Requests\CompraPedidoStoreRequest;
use App\Http\Requests\CompraPedidoUpdateRequest;
use App\Models\CompraPedidoItem;
use App\Models\Produto;
use App\Services\CompraPedidoService;
use Symfony\Component\VarDumper\VarDumper;

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
            ->paginate(5)
            ->withQueryString();
        
        

        return view(
            'app.compra_pedidos.index',
            compact('compraPedidos', 'search', 'total'),
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', CompraPedido::class);

        $clientes = Cliente::pluck('nome', 'id');
        $compraPedidoStatuses = CompraPedidoStatus::pluck('descricao', 'id');
        
        
        
        return view(
            'app.compra_pedidos.create',
            compact('clientes', 'compraPedidoStatuses'),
        );
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

        return redirect()
            ->route('compra-pedidos.edit', $compraPedido)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CompraPedido $compraPedido
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, CompraPedido $compraPedido)
    {
        $this->authorize('view', $compraPedido);

        return view('app.compra_pedidos.show', compact('compraPedido'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CompraPedido $compraPedido
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, CompraPedido $compraPedido)
    {
        $this->authorize('update', $compraPedido);

        $clientes               = Cliente::pluck('nome', 'id');
        $compraPedidoStatuses   = CompraPedidoStatus::pluck('descricao', 'id');
        $compraPedidoItems      = CompraPedidoItem::where("compra_pedido_id", '=', $compraPedido->id)->get();
        $produtos               = Produto::all();

        $total = 0;
        
        foreach($compraPedidoItems as $item) {
            $total += $item->produto->valor_unitario * $item->quantidade;
        }

        return view(
            'app.compra_pedidos.edit',
            compact('compraPedido', 'clientes', 'compraPedidoStatuses', 'compraPedidoItems', 'produtos', 'total'),
            
        );
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

        return redirect()
            ->route('compra-pedidos.edit', $compraPedido)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('compra-pedidos.index')
            ->withSuccess(__('crud.common.removed'));
    }

    /**
     * Return the dimensioned data to datatable
     * 
     * @param \Illuminate\Http\Request $request
     * @return @return \Illuminate\Http\Response
     */
    public function getCompraPedidosToDatatable(Request $request, CompraPedidoService $compraPedidoService)
    {
        return $compraPedidoService->getCompraPedidosToDatatable($request);
    }
}
