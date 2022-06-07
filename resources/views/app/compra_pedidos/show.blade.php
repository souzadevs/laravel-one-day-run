@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('compra-pedidos.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.compra_pedidos.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.compra_pedidos.inputs.pedido_at')</h5>
                    <span>{{ $compraPedido->pedido_at ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.compra_pedidos.inputs.cliente_id')</h5>
                    <span
                        >{{ optional($compraPedido->cliente)->nome ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.compra_pedidos.inputs.compra_pedido_status_id')
                    </h5>
                    <span
                        >{{
                        optional($compraPedido->compraPedidoStatus)->descricao
                        ?? '-' }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('compra-pedidos.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\CompraPedido::class)
                <a
                    href="{{ route('compra-pedidos.create') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
