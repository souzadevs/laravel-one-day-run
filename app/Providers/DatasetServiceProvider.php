<?php

namespace App\Providers;

use App\Lib\Dataset\Dataset;
use App\Lib\Dataset\IDataset;
use App\Models\Cliente;
use App\Models\Produto;
use Illuminate\Support\ServiceProvider;

class DatasetServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(IDataset::class, Dataset::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
