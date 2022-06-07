<?php

namespace App\Lib\Dataset;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface IDataset
{
    public function build(Request $request, Model $model);
}