<?php 

namespace App\Services;

use Illuminate\Http\Request;
use App\Lib\Dataset\IDataset;
use App\Models\Contracts\ICliente;

class ClienteService 
{
    private ICliente $cliente;
    private IDataset $dataset;

    public function __construct(ICliente $cliente, IDataset $dataset)
    {
        $this->cliente = $cliente;
        $this->dataset = $dataset;
    }

    public function getClientesToDatatable(Request $request)
    {
        return $this->dataset->build($request, $this->cliente);
    }
}