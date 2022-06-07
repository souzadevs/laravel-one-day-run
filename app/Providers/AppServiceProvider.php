<?php

namespace App\Providers;

use App\Lib\Dataset\DatasetToCompraPedido;
use App\Lib\Dataset\DatasetToCompraPedidoItem;
use App\Lib\Dataset\IDataset;
use App\Models\Cliente;
use App\Models\CompraPedido;
use App\Models\CompraPedidoItem;
use App\Models\CompraPedidoStatus;
use App\Models\Contracts\ICliente;
use App\Models\Contracts\ICompraPedido;
use App\Models\Contracts\ICompraPedidoItem;
use App\Models\Contracts\ICompraPedidoStatus;
use App\Models\Contracts\IProduto;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Models\Produto;
use App\Services\CompraPedidoItemService;
use App\Services\CompraPedidoService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Paginator::useBootstrap();

        $this->app->bind(IProduto::class,             Produto::class);
        $this->app->bind(ICliente::class,             Cliente::class);
        $this->app->bind(ICompraPedido::class,        CompraPedido::class);
        $this->app->bind(ICompraPedidoItem::class,    CompraPedidoItem::class);
        $this->app->bind(ICompraPedidoStatus::class,  CompraPedidoStatus::class);

        $this->app->when(CompraPedidoService::class)
        ->needs(IDataset::class)
        ->give(function($app){
            return (new DatasetToCompraPedido());
        });
        
        $this->app->when(CompraPedidoItemService::class)
        ->needs(IDataset::class)
        ->give(function($app){
            return (new DatasetToCompraPedidoItem());
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
