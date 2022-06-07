@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('produtos.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.produtos.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.produtos.inputs.valor_unitario')</h5>
                    <span>{{ $produto->valor_unitario ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.produtos.inputs.codigo_barras')</h5>
                    <span>{{ $produto->codigo_barras ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.produtos.inputs.nome')</h5>
                    <span>{{ $produto->nome ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('produtos.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Produto::class)
                <a href="{{ route('produtos.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
