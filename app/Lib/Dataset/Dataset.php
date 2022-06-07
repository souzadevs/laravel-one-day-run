<?php

namespace App\Lib\Dataset;

use App\Lib\Dataset\IDataset;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\VarDumper;

class Dataset implements IDataset
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

            $models->skip($start);
            $models->take($rowsPerPage);
            $models = $models->get();
        } else {
            $models = $models->get();
        }
        
        $data = [];
        
        foreach ($models as $model) {
            $dataModel = [];
            foreach ($request->columns as $column) {
                $columnName = $column['data'];
                $dataModel[$columnName] = $model->$columnName;
            }
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
