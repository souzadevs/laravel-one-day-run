@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body" >
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h4 class="card-title">
                            <a href="{{ route('compra-pedidos.index') }}" class="mr-4"><i class="icon ion-md-arrow-back"></i></a>
                            @lang('crud.compra_pedidos.edit_title')
                        </h4>

                        <x-form method="PUT" action="{{ route('compra-pedidos.update', $compraPedido) }}" class="mt-4">
                            @include('app.compra_pedidos.form-inputs')

                            <div class="mt-4">
                                <a href="{{ route('compra-pedidos.index') }}" class="btn btn-light">
                                    <i class="icon ion-md-return-left text-primary"></i>
                                    @lang('crud.common.back')
                                </a>

                                <a href="{{ route('compra-pedidos.create') }}" class="btn btn-light">
                                    <i class="icon ion-md-add text-primary"></i>
                                    @lang('crud.common.create')
                                </a>

                                <button type="submit" class="btn btn-primary float-right">
                                    <i class="icon ion-md-save"></i>
                                    @lang('crud.common.update')
                                </button>
                            </div>
                        </x-form>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-dark">
                                <h4 class="card-title">
                                    Itens
                                </h4>
                            </div>
                            <div class="card-body" >
                                <div class="container-fluid">
                                    <div class="row mb-5">
                                        <div class="col-4">
                                            <label for="" class="text-muted">
                                                Selecione um produto
                                            </label>
                                            <select class="form-control" name="add-produto" id="add-produto">
                                                @foreach($produtos as $produto)
                                                <option value="{{$produto->id}}">
                                                    {{$produto->nome . '  [R$: ' . $produto->valor_unitario . ']'}}
                                                </option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <div class="col-2">
                                        <label for="" class="text-muted">
                                                Quantidade
                                            </label>
                                            <input type="text" value="1" name="quantidade" id="quantidade" class="form-control" placeholder="Quantidade">
                                        </div>
                                        <div class="col-2">
                                            <button onclick="addProduto(event)" class="btn btn-success" style="margin-top:32px">
                                            
                                                <i class="fas fa-plus"></i> Adicionar
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table id="compra-pedidos-itens-datatable" class="table table-borderless table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-left">
                                                                @lang('crud.compra_pedido_items.inputs.produto_id')
                                                            </th>
                                                            <th class="text-left">
                                                                CÓD. BARRAS
                                                            </th>
                                                            <th class="text-cemter">
                                                                Preço
                                                            </th>
                                                            <th class="text-center">
                                                                @lang('crud.compra_pedido_items.inputs.quantidade')
                                                            </th>
                                                            <th class="text-center">
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
                                                            <td>{{ $compraPedidoItem->valor_unitario ?? '-' }}</td>
                                                            <td>{{ $compraPedidoItem->quantidade ?? '-' }}</td>
                                                            <td>
                                                                {{
                                            $compraPedidoItem->subtotal
                                        }}
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
                                        function updateTotal(total) {
                                            document.getElementById("total-feld").innerHTML = Number(total).toLocaleString('pt-br', {minimumFractionDigits: 2});
                                        }

                                        function remItem(id) {
                                            if(confirm("Tem certeza que deseja excluir?")) {
                                                axios({
                                                'method': 'delete',
                                                'url': '/delete-compra-pedido-items/' + id,
                                            }).then(response => {
                                                const notyf = new Notyf({
                                                    dismissible: true
                                                })
                                                notyf.success('Removido com sucesso!')
                                                let table = $('#compra-pedidos-itens-datatable').DataTable();
                                                table.ajax.reload();
                                                updateTotal(response.data.total);
                                            }).catch(response => {
                                                console.log(response);
                                                const notyf = new Notyf({
                                                    dismissible: true
                                                })
                                                notyf.error('Ops! Algo deu errado...')
                                            })
                                            }

                                        }

                                        function addProduto(e) {
                                            // name="add-produto" id="add-produto"
                                            // name="quantidade" id="quantidade"
                                            let quantidade = document.getElementById('quantidade').value;
                                            if (quantidade > 0) {
                                                let produto_id = document.getElementById('add-produto').value;

                                                axios({
                                                    'method': 'post',
                                                    'url': '/compra-pedido-items',
                                                    'data': {
                                                        quantidade: quantidade,
                                                        produto_id: produto_id,
                                                        compra_pedido_id: '{{$compraPedido->id}}'
                                                    }
                                                }).then(response => {
                                                    const notyf = new Notyf({
                                                        dismissible: true
                                                    })
                                                    notyf.success('Adicionado com sucesso!')
                                                    let table = $('#compra-pedidos-itens-datatable').DataTable();
                                                    table.ajax.reload();
                                                    
                                                    updateTotal(response.data.total);
                                                }).catch(response => {
                                                   
                                                    const notyf = new Notyf({
                                                        dismissible: true
                                                    })
                                                    notyf.error('Ops! Algo deu errado...')
                                                })
                                            } else {
                                                alert("Digite uma quantidade.");
                                            }
                                        }

                                        $(document).ready(function() {
                                            $('#compra-pedidos-itens-datatable').DataTable({
                                                "processing": true,
                                                "serverSide": true,
                                                "paging": true,
                                                "pageLength": 20,
                                                "lengthMenu": [20, 50, 100],
                                                "scrollCollapse": true,
                                                "stateSave": true,
                                                "language": language,
                                                ajax: {
                                                    'url': '{{route('compra-pedidos-itens.dataset')}}',
                                                    'data' : {
                                                            compra_pedido_id: {{$compraPedido->id}}
                                                        }
                                                },
                                                columns: [{
                                                        data: 'id',
                                                        width: '10%'
                                                    },
                                                    {
                                                        data: 'codigo_barras',
                                                        width: '30%'
                                                    },
                                                    {
                                                        data: 'valor_unitario',
                                                        width: '15%'
                                                    },
                                                    {
                                                        data: 'quantidade',
                                                        width: '15%'
                                                    },
                                                    {
                                                        data: 'subtotal',
                                                        width: '15%'
                                                    },
                                                    {
                                                        data: 'id',
                                                        width: '5%'
                                                    },
                                                ],
                                                columnDefs: [{
                                                        'target': 5,
                                                        'render': function(data) {

                                                            return `
                                                                    <div role="group" aria-label="Row Actions" class="btn-group">
                                                                        
                                                                            <button onclick="remItem(${data})" class="btn btn-light text-danger">
                                                                                <i class="icon ion-md-trash"></i>
                                                                            </button>
                                                                       
                                                                    </div>
                                                            `;
                                                        }
                                                    },
                                                    {
                                                        'target': [0, 1, 2, 3],
                                                        'className': 'dt-center'
                                                    },
                                                    {
                                                        'target': 0,
                                                        'render': function(data) {
                                                            return `
                                                                <a href="/produtos/${data}/edit">${data}</a>
                                                            `;
                                                        }
                                                    }

                                                ]
                                            });

                                            updateTotal({{$total}})
                                        });
                                    </script>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button  class="btn btn-info elevation-1">
                                    <b>Total (R$): </b> <span id="total-feld" style="font-family: 'Quicksand', sans-serif;">{{$total}}</span>
                                </button>
                            </div>
                        </div>


                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection