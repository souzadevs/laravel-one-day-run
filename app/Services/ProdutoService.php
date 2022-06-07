<?php 

namespace App\Services;

use Illuminate\Http\Request;
use App\Lib\Dataset\IDataset;
use App\Models\Contracts\IProduto;

class ProdutoService 
{
    private IProduto $produto;
    private IDataset $dataset;

    function __construct(IProduto $produto, IDataset $dataset)
    {
        $this->produto = $produto;
        $this->dataset = $dataset;
    }

    public function getProdutosToDatatable(Request $request)
    {
        return $this->dataset->build($request, $this->produto);
    }
}