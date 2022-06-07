@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row">
            <div class="col-md-6">
            </div>
            <div class="col-md-6 text-right">
                @can('create', App\Models\CompraPedido::class)
                <a href="{{ route('compra-pedidos.create') }}" class="btn btn-primary">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-dark">
            <h4 class="card-title">
                @lang('crud.compra_pedidos.index_title')
            </h4>

        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table id="compra-pedidos-datatable" class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-left">
                                Nº PEDIDO
                            </th>
                            <th class="text-left">
                                @lang('crud.compra_pedidos.inputs.pedido_at')
                            </th>
                            <th class="text-left">
                                @lang('crud.compra_pedidos.inputs.cliente_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.compra_pedidos.inputs.compra_pedido_status_id')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($compraPedidos as $compraPedido)
                        <tr>
                            <td>{{ $compraPedido->id }}</td>
                            <td>{{ $compraPedido->pedido_at ?? '-' }}</td>
                            <td>
                                {{ optional($compraPedido->cliente)->nome ?? '-'
                                }}
                            </td>
                            <td>
                                {{
                                optional($compraPedido->compraPedidoStatus)->descricao
                                ?? '-' }}
                            </td>
                            <td class="text-center" style="width: 134px;">
                                
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
        
    </div>
    <script>
            $(document).ready(function() {
                $('#compra-pedidos-datatable').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "paging": true,
                    "pageLength": 20,
                    "lengthMenu": [20, 50, 100],
                    "scrollCollapse": true,
                    "stateSave": true,
                    "language": language,
                    ajax: "{{route('compra-pedidos.dataset')}}",
                    columns: [{
                            data: 'id',
                            width:'10%'
                        },
                        {
                            data: 'pedido_at',
                            width:'10%'
                        },
                        {
                            data: 'cliente_id',
                            width:'40%'
                        },
                        {
                            data: 'compra_pedido_status_id',
                            width:'15%'
                        },
                        {
                            data: 'id',
                            width:'5%'
                        },
                    ],
                    columnDefs: [
                        {
                            'target': 4,
                            'render': function(data) {

                                return `
                                <div role="group" aria-label="Row Actions" class="btn-group">
                                        <a href="/compra-pedidos/${data}/edit">
                                            <button type="button" class="btn btn-light">
                                                <i class="icon ion-md-create"></i>
                                            </button>
                                        </a>
                                        <form action="/compra-pedidos/${data}" method="POST" onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-light text-danger">
                                                <i class="icon ion-md-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                `;
                            }
                        },
                        {
                            'target':[0,1,3],
                            'className': 'dt-center'
                        },
                        {
                            'target': 2,
                            'render': function(data) {
                                return `
                                    <a href="/clientes/${data.id}/edit">${data.nome}</a>
                                `;
                            }
                        }

                ]
                });
            });
        </script>
</div>
@endsection