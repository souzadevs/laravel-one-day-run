<?php 

namespace App\Services;

use Illuminate\Http\Request;
use App\Lib\Dataset\IDataset;
use App\Models\Contracts\ICompraPedido;

class CompraPedidoService 
{
    private ICompraPedido $compraPedido;
    private IDataset $dataset;

    public function __construct(ICompraPedido $compraPedido, IDataset $dataset)
    {
        $this->compraPedido = $compraPedido;
        $this->dataset = $dataset;
    }

    public function getCompraPedidosToDatatable(Request $request)
    {
        return $this->dataset->build($request, $this->compraPedido);
    }
}