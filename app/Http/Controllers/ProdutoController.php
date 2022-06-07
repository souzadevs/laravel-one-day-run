<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use App\Http\Requests\ProdutoStoreRequest;
use App\Http\Requests\ProdutoUpdateRequest;
use App\Services\ProdutoService;

class ProdutoController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Produto::class);

        $search = $request->get('search', '');

        $produtos = Produto::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.produtos.index', compact('produtos', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Produto::class);

        return view('app.produtos.create');
    }

    /**
     * @param \App\Http\Requests\ProdutoStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdutoStoreRequest $request)
    {
        $this->authorize('create', Produto::class);

        $validated = $request->validated();

        $produto = Produto::create($validated);

        return redirect()
            ->route('produtos.edit', $produto)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Produto $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Produto $produto)
    {
        $this->authorize('view', $produto);

        return view('app.produtos.show', compact('produto'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Produto $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Produto $produto)
    {
        $this->authorize('update', $produto);

        return view('app.produtos.edit', compact('produto'));
    }

    /**
     * @param \App\Http\Requests\ProdutoUpdateRequest $request
     * @param \App\Models\Produto $produto
     * @return \Illuminate\Http\Response
     */
    public function update(ProdutoUpdateRequest $request, Produto $produto)
    {
        $this->authorize('update', $produto);

        $validated = $request->validated();

        $produto->update($validated);

        return redirect()
            ->route('produtos.edit', $produto)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Produto $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Produto $produto)
    {
        $this->authorize('delete', $produto);

        $produto->delete();

        return redirect()
            ->route('produtos.index')
            ->withSuccess(__('crud.common.removed'));
    }

    /**
     * Return the dimensioned data to datatable
     * 
     * @param \Illuminate\Http\Request $request
     * @return @return \Illuminate\Http\Response
     */
    public function getProdutosToDatatable(Request $request, ProdutoService $produtoService)
    {
        return $produtoService->getProdutosToDatatable($request);
    }
}
