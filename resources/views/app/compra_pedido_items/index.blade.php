@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row">
            <div class="col-md-6">
                <form>
                    <div class="input-group">
                        <input id="indexSearch" type="text" name="search" placeholder="{{ __('crud.common.search') }}" value="{{ $search ?? '' }}" class="form-control" autocomplete="off" />
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">
                                <i class="icon ion-md-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 text-right">
                @can('create', App\Models\CompraPedidoItem::class)
                <a href="{{ route('compra-pedido-items.create') }}" class="btn btn-primary">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">
                    @lang('crud.compra_pedido_items.index_title')
                </h4>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-left">
                                @lang('crud.compra_pedido_items.inputs.produto_id')
                            </th>
                            <th class="text-left">
                                CÓD. BARRAS
                            </th>
                            <th class="text-right">
                                @lang('crud.compra_pedido_items.inputs.quantidade')
                            </th>
                            <th class="text-right">
                                Subtotal
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($compraPedidoItems as $compraPedidoItem)
                        <tr>
                            <td>{{ $compraPedidoItem->id }}</td>
                            <td>
                                {{
                                optional($compraPedidoItem->produto)->codigo_barras
                                ?? '-' }}
                            </td>
                            <td>{{ $compraPedidoItem->quantidade ?? '-' }}</td>
                            <td>
                                {{
                                    ($compraPedidoItem->quantidade * $compraPedidoItem->produto->valor_unitario)
                                }}
                            </td>
                            <td class="text-center" style="width: 134px;">
                                <div role="group" aria-label="Row Actions" class="btn-group">
                                    @can('update', $compraPedidoItem)
                                    <a href="{{ route('compra-pedido-items.edit', $compraPedidoItem) }}">
                                        <button type="button" class="btn btn-light">
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $compraPedidoItem)
                                    <a href="{{ route('compra-pedido-items.show', $compraPedidoItem) }}">
                                        <button type="button" class="btn btn-light">
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $compraPedidoItem)
                                    <form action="{{ route('compra-pedido-items.destroy', $compraPedidoItem) }}" method="POST" onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-light text-danger">
                                            <i class="icon ion-md-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
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
                    <tfoot>
                        <tr>
                            <td colspan="4">
                                {!! $compraPedidoItems->render() !!}
                            </td>
                        </tr>
                    </tfoot>
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
                        width: '10%'
                    },
                    {
                        data: 'pedido_at',
                        width: '10%'
                    },
                    {
                        data: 'cliente_id',
                        width: '40%'
                    },
                    {
                        data: 'compra_pedido_status_id',
                        width: '15%'
                    },
                    {
                        data: 'id',
                        width: '5%'
                    },
                ],
                columnDefs: [{
                        'target': 4,
                        'render': function(data) {

                            return `
                                <div role="group" aria-label="Row Actions" class="btn-group">
                                        <a href="/produtos/${data}/edit">
                                            <button type="button" class="btn btn-light">
                                                <i class="icon ion-md-create"></i>
                                            </button>
                                        </a>
                                        <form action="/produtos/${data}" method="POST" onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')">
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
                        'target': [0, 1, 3],
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