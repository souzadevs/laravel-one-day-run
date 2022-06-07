<?php 

namespace App\Services;

use Illuminate\Http\Request;
use App\Lib\Dataset\IDataset;
use App\Models\Contracts\ICompraPedidoItem;
use App\Models\Contracts\ICompraPedidoStatus;

class CompraPedidoStatusService 
{
    private ICompraPedidoStatus $compraPedidoStatus;
    private IDataset $dataset;

    public function __construct(ICompraPedidoStatus $compraPedidoStatus, IDataset $dataset)
    {
        $this->compraPedidoStatus = $compraPedidoStatus;
        $this->dataset = $dataset;
    }

    public function getCompraPedidoStatusToDatatable(Request $request)
    {
        return $this->dataset->build($request, $this->compraPedidoStatus);
    }
}