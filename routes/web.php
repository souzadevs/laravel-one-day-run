<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CompraPedidoController;
use App\Http\Controllers\CompraPedidoItemController;
use App\Http\Controllers\CompraPedidoStatusController;
use App\Models\CompraPedidoItem;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('users',                    UserController::class);
        Route::resource('clientes',                 ClienteController::class);
        Route::resource('produtos',                 ProdutoController::class);
        Route::resource('compra-pedidos',           CompraPedidoController::class);
        Route::resource('compra-pedido-items',      CompraPedidoItemController::class);
        Route::resource('compra-pedido-statuses',   CompraPedidoStatusController::class);

        Route::delete('/delete-compra-pedido-items/{id}',   [CompraPedidoItemController::class, 'delete']);

        Route::get('users-dataset',                 [ProdutoController::class,            'getUsersToDatatable'  ])            ->name("users.dataset");
        Route::get('clientes-dataset',              [ClienteController::class,            'getClientesToDatatable'])           ->name("clientes.dataset");
        Route::get('produtos-dataset',              [ProdutoController::class,            'getProdutosToDatatable'])           ->name("produtos.dataset");
        Route::get('compra-pedidos-dataset',        [CompraPedidoController::class,       'getCompraPedidosToDatatable'])      ->name("compra-pedidos.dataset");
        Route::get('compra-pedidos-itens-dataset',  [CompraPedidoItemController::class,   'getCompraPedidosItensToDatatable']) ->name("compra-pedidos-itens.dataset");
        Route::get('compra-pedidos-status-dataset', [CompraPedidoStatusController::class, 'getCompraPedidoStatusToDatatable']) ->name("compra-pedidos-status.dataset");
    });