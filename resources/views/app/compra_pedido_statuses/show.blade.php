@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a
                    href="{{ route('compra-pedido-statuses.index') }}"
                    class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.compra_pedido_statuses.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>
                        @lang('crud.compra_pedido_statuses.inputs.descricao')
                    </h5>
                    <span>{{ $compraPedidoStatus->descricao ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.compra_pedido_statuses.inputs.cor_fundo_hex')
                    </h5>
                    <span>{{ $compraPedidoStatus->cor_fundo_hex ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.compra_pedido_statuses.inputs.cor_texto_hex')
                    </h5>
                    <span>{{ $compraPedidoStatus->cor_texto_hex ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('compra-pedido-statuses.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\CompraPedidoStatus::class)
                <a
                    href="{{ route('compra-pedido-statuses.create') }}"
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
