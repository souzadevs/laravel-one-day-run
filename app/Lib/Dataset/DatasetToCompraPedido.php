<?php

namespace App\Lib\Dataset;

use App\Lib\Dataset\IDataset;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Symfony\Component\VarDumper\VarDumper;

class DatasetToCompraPedido implements IDataset
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

        if ($searchValue != null) {

            foreach ($request->columns as $column) {
                $models->orWhere($column['data'], 'like', '%' . $searchValue . '%');
            }

            $models->with(
                [
                    'cliente' => function ($query) {
                    },
                    'compraPedidoStatus' => function ($query) {
                    },
                ]
            );
            $models->skip($start);
            $models->take($rowsPerPage);
            $models = $models->get();
        } else {
            $models = $models->with([
                'cliente' => function ($query) {
                },
                'compraPedidoStatus' => function ($query) {
                },
            ])->get();
        }

        $data = [];

        foreach ($models as $model) {
            $dataModel = [];

            $dataModel['id']                        = $model->id;
            $dataModel['cliente_id']                = $model->cliente;
            $dataModel['pedido_at']                 = (new DateTime($model->pedido_at))->format('d/m/Y');
            $dataModel['compra_pedido_status_id']   = $model->compraPedidoStatus['descricao'];

            array_push($data, $dataModel);
        }



        return [
            'draw'                  => $draw,
            'iTotalRecords'         => $tableTotalRows,
            'iTotalDisplayRecords'  => $tableQtdFilteredRows,
            'aaData'                => $data
        ];
    }
}
