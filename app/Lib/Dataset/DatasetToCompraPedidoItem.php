<?php

namespace App\Lib\Dataset;

use App\Lib\Dataset\IDataset;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Symfony\Component\VarDumper\VarDumper;

class DatasetToCompraPedidoItem implements IDataset
{
    public function build(Request $request, Model $model)
    {
        $draw                   = $request->draw;
        $start                  = $request->start;
        $rowsPerPage            = $request->length;

        $columnIndex            = $request->order[0]['column'];
        $columnName             = $request->columns[$columnIndex]['data'];
        $columnSortOrder        = $request->order[0]['dir'];
        $searchValue            = $request->search['value'];

        $tableTotalRows         = $model::all()->count();
        $tableQtdFilteredRows   = $model::where($columnName, 'LIKE', '%' . $searchValue . '%')->get()->count();

        $models = $model->orderBy($columnName, $columnSortOrder);
        
        $models->where("compra_pedido_id", '=', $request->compra_pedido_id);

        if ($searchValue != null) {

            foreach ($request->columns as $column) {
                $models->orWhere($column['data'], 'like', '%' . $searchValue . '%');
            }

            $models->with(
                [
                    'produto' => function ($query) {
                    },
                    'compraPedido' => function ($query) {
                    },
                ]
            );
            $models->skip($start);
            $models->take($rowsPerPage);
            $models = $models->get();
        } else {
            $models = $models->with([
                'produto' => function ($query) {
                },
                'compraPedido' => function ($query) {
                },
            ])->get();
        }

        $data = [];

        foreach ($models as $model) {
            $dataModel = [];

            $dataModel['id']                        = $model->id;
            $dataModel['codigo_barras']             = $model->produto->codigo_barras;
            $dataModel['quantidade']                = $model->quantidade;
            $dataModel['valor_unitario']            = $model->produto->valor_unitario;
            $dataModel['subtotal']                  = $model->quantidade * (double)$model->produto->valor_unitario;

            array_push($data, $dataModel);
        }



        return [
            'draw'                  => $draw,
            'iTotalRecords'         => $tableTotalRows,
            'iTotalDisplayRecords'  => $tableQtdFilteredRows,
            'aaData'                => $data,
            'total'                 => 10
        ];
    }
}
