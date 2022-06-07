<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\Api\ProdutoController;
use App\Http\Controllers\Api\CompraPedidoController;
use App\Http\Controllers\Api\CompraPedidoItemController;
use App\Http\Controllers\Api\CompraPedidoStatusController;
use App\Http\Controllers\Api\ClienteCompraPedidosController;
use App\Http\Controllers\Api\ProdutoCompraPedidoItemsController;
use App\Http\Controllers\Api\CompraPedidoCompraPedidoItemsController;
use App\Http\Controllers\Api\CompraPedidoStatusCompraPedidosController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('clientes', ClienteController::class);

        // Cliente Compra Pedidos
        Route::get('/clientes/{cliente}/compra-pedidos', [ClienteCompraPedidosController::class, 'index'])->name('clientes.compra-pedidos.index');
        Route::post('/clientes/{cliente}/compra-pedidos', [ClienteCompraPedidosController::class, 'store'])->name('clientes.compra-pedidos.store');
        Route::apiResource('compra-pedidos', CompraPedidoController::class);

        // CompraPedido Compra Pedido Items
        Route::get(
            '/compra-pedidos/{compraPedido}/compra-pedido-items',
            [
                CompraPedidoCompraPedidoItemsController::class,
                'index'
            ]
        )->name('compra-pedidos.compra-pedido-items.index');

        Route::post(
            '/compra-pedidos/{compraPedido}/compra-pedido-items',
            [
                CompraPedidoCompraPedidoItemsController::class,
                'store',
            ]
        )->name('compra-pedidos.compra-pedido-items.store');

        Route::apiResource(
            'compra-pedido-items',
            CompraPedidoItemController::class
        );

        Route::apiResource(
            'compra-pedido-statuses',
            CompraPedidoStatusController::class
        );

        // CompraPedidoStatus Compra Pedidos
        Route::get(
            '/compra-pedido-statuses/{compraPedidoStatus}/compra-pedidos',
            [
                CompraPedidoStatusCompraPedidosController::class, 'index'
            ]
        )->name('compra-pedido-statuses.compra-pedidos.index');

        Route::post(
            '/compra-pedido-statuses/{compraPedidoStatus}/compra-pedidos',
            [
                CompraPedidoStatusCompraPedidosController::class, 'store'
            ]
        )->name('compra-pedido-statuses.compra-pedidos.store');

        Route::apiResource('produtos', ProdutoController::class);

        // Produto Compra Items
        Route::get(
            '/produtos/{produto}/compra-pedido-items',
            [
                ProdutoCompraPedidoItemsController::class,
                'index',
            ]
        )->name('produtos.compra-pedido-items.index');
        
        Route::post(
            '/produtos/{produto}/compra-pedido-items',
            [
                ProdutoCompraPedidoItemsController::class,
                'store',
            ]
        )->name('produtos.compra-pedido-items.store');

        Route::apiResource('users', UserController::class);
    });
