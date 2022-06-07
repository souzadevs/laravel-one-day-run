<?php 

namespace App\Services;

use Illuminate\Http\Request;
use App\Lib\Dataset\IDataset;
use App\Models\Contracts\ICompraPedidoItem;

class CompraPedidoItemService 
{
    private ICompraPedidoItem $compraPedidoItem;
    private IDataset $dataset;

    public function __construct(ICompraPedidoItem $compraPedidoItem, IDataset $dataset)
    {
        $this->compraPedidoItem = $compraPedidoItem;
        $this->dataset = $dataset;
    }

    public function getCompraPedidosItensToDatatable(Request $request)
    {
        return $this->dataset->build($request, $this->compraPedidoItem);
    }
}