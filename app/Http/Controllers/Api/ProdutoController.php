<?php

namespace App\Http\Controllers\Api;

use App\Models\Produto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProdutoResource;
use App\Http\Resources\ProdutoCollection;
use App\Http\Requests\ProdutoStoreRequest;
use App\Http\Requests\ProdutoUpdateRequest;

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
            ->paginate();

        return new ProdutoCollection($produtos);
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

        return new ProdutoResource($produto);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Produto $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Produto $produto)
    {
        $this->authorize('view', $produto);

        return new ProdutoResource($produto);
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

        return new ProdutoResource($produto);
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

        return response()->noContent();
    }
}
