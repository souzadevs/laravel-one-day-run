@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$pedidosEmAberto}}</h3>
                    <p>Pedidos em aberto</p>

                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="/compra-pedidos/" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$pedidosPagos}}</h3>
                    <p>Pedidos pagos</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="/compra-pedidos/" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
            </div>

        </div>
        <div class="col-md-4">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{$pedidosCancelados}}</h3>
                    <p>Pedidos cancelados</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="/compra-pedidos/" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-md-12">
                <a href="/compra-pedidos/create" class="btn btn-primary w-100 elevation-2">
                    <b>
                        NOVO PEDIDO
                    </b>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection