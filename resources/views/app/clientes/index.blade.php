@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row">
            <div class="col-md-6">
                
            </div>
            <div class="col-md-6 text-right">
                @can('create', App\Models\Cliente::class)
                <a href="{{ route('clientes.create') }}" class="btn btn-primary">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-dark">
            <h4 class="card-title">@lang('crud.clientes.index_title')</h4>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table id="clientes-datatable" class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-left">
                                @lang('crud.clientes.inputs.nome')
                            </th>
                            <th class="text-left">
                                @lang('crud.clientes.inputs.cpf')
                            </th>
                            <th class="text-left">
                                @lang('crud.clientes.inputs.email')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->nome ?? '-' }}</td>
                            <td>{{ $cliente->cpf ?? '-' }}</td>
                            <td>{{ $cliente->email ?? '-' }}</td>
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
        <script>
            $(document).ready(function() {
                $('#clientes-datatable').DataTable({
                    "ordering": true,
                    "processing": true,
                    "serverSide": true,
                    "paging": true,
                    "pageLength": 20,
                    "lengthMenu": [20, 50, 100],
                    "sScrollX": "100%",
                    "scrollCollapse": true,
                    "stateSave": true,
                    "language":language,
                    ajax: "{{route('clientes.dataset')}}",
                    columns: [{
                            data: 'nome',
                            width: '20%',
                        },
                        {
                            data: 'cpf',
                            width: '20%',
                        },
                        {
                            data: 'email',
                            width: '35%',
                        },
                        {
                            data: 'id',
                            width: '5%',
                        },
                    ],
                    columnDefs: [{
                        'target': 3,
                        'render': function(data) {

                            return `
                            <div role="group" aria-label="Row Actions" class="btn-group">
                                    <a href="/clientes/${data}/edit">
                                        <button type="button" class="btn btn-light">
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    <form action="/clientes/${data}" method="POST" onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-light text-danger">
                                            <i class="icon ion-md-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            `;
                        }
                    }]
                });
            });
        </script>
    </div>
</div>
@endsection