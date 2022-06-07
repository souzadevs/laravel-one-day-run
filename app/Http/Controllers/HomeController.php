<?php

namespace App\Http\Controllers;

use App\Models\CompraPedido;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            'pedidosEmAberto'   => CompraPedido::where("compra_pedido_status_id", 1)->count(),
            'pedidosPagos'      => CompraPedido::where("compra_pedido_status_id", 2)->count(),
            'pedidosCancelados' => CompraPedido::where("compra_pedido_status_id", 3)->count(),
        ]);
    }
}
