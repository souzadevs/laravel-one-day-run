@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('compra-pedido-items.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.compra_pedido_items.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.compra_pedido_items.inputs.quantidade')</h5>
                    <span>{{ $compraPedidoItem->quantidade ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.compra_pedido_items.inputs.produto_id')</h5>
                    <span
                        >{{ optional($compraPedidoItem->produto)->codigo_barras
                        ?? '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.compra_pedido_items.inputs.compra_pedido_id')
                    </h5>
                    <span
                        >{{ optional($compraPedidoItem->compraPedido)->id ?? '-'
                        }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('compra-pedido-items.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\CompraPedidoItem::class)
                <a
                    href="{{ route('compra-pedido-items.create') }}"
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
