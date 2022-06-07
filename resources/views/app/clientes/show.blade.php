@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('clientes.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.clientes.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.clientes.inputs.nome')</h5>
                    <span>{{ $cliente->nome ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.clientes.inputs.cpf')</h5>
                    <span>{{ $cliente->cpf ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.clientes.inputs.email')</h5>
                    <span>{{ $cliente->email ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('clientes.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Cliente::class)
                <a href="{{ route('clientes.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
