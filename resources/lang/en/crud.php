<?php

return [
    'common' => [
        'actions' => 'AÇÕES',
        'create' => 'Novo',
        'edit' => 'Editarar',
        'update' => 'Atualizar',
        'new' => 'Novo',
        'cancel' => 'Cancelar',
        'attach' => 'Anexar',
        'detach' => 'Desvincular',
        'save' => 'Salvar',
        'delete' => 'Deletar',
        'delete_selected' => 'Deletar selecionado',
        'search' => 'Procurar...',
        'back' => 'Voltar ao início',
        'are_you_sure' => 'Tem certeza?',
        'no_items_found' => 'Nenhum item encontrado',
        'created' => 'Criado com sucesso',
        'saved' => 'Salvo com sucesso',
        'removed' => 'Removido com sucesso',
    ],

    'clientes' => [
        'name' => 'Clientes',
        'index_title' => 'Clientes',
        'new_title' => 'Novo cliente',
        'create_title' => 'Novo cliente',
        'edit_title' => 'Editarar cliente',
        'show_title' => 'Visualizar cliente',
        'inputs' => [
            'nome' => 'NOME',
            'cpf' => 'CPF',
            'email' => 'E-MAIL',
        ],
    ],

    'compra_pedidos' => [
        'name' => 'Pedidos de compra',
        'index_title' => 'Pedidos',
        'new_title' => 'Novo pedido',
        'create_title' => 'Novo pedido',
        'edit_title' => 'Pedido',
        'show_title' => 'Visualizar pedido',
        'inputs' => [
            'pedido_at' => 'DATA',
            'cliente_id' => 'CLIENTE',
            'compra_pedido_status_id' => 'STATUS',
        ],
    ],

    'compra_pedido_items' => [
        'name' => 'Itens do pedido',
        'index_title' => 'Itens do pedido List',
        'new_title' => 'Novo item do pedido',
        'create_title' => 'Novo item do pedido',
        'edit_title' => 'Editarar item do pedido',
        'show_title' => 'Visualizar item do pedido',
        'inputs' => [
            'quantidade' => 'QTD.',
            'produto_id' => 'PRODUTO ID',
            'compra_pedido_id' => 'PEDIDO ID',
        ],
    ],

    'compra_pedido_statuses' => [
        'name' => 'Compra Pedido Statuses',
        'index_title' => 'CompraPedidoStatuses List',
        'new_title' => 'Novo Compra pedido status',
        'create_title' => 'Novo CompraPedidoStatus',
        'edit_title' => 'Editar CompraPedidoStatus',
        'show_title' => 'Visualizar CompraPedidoStatus',
        'inputs' => [
            'descricao' => 'Descricao',
            'cor_fundo_hex' => 'Cor Fundo Hex',
            'cor_texto_hex' => 'Cor Texto Hex',
        ],
    ],

    'produtos' => [
        'name' => 'Produtos',
        'index_title' => 'Produtos',
        'new_title' => 'Novo Produto',
        'create_title' => 'Novo produto',
        'edit_title' => 'Editar produto',
        'show_title' => 'Visualizar produto',
        'inputs' => [
            'valor_unitario' => 'VALOR UN.',
            'codigo_barras' => 'CÓD. BARRAS',
            'nome' => 'NOME',
        ],
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'new_title' => 'Novo User',
        'create_title' => 'Novo User',
        'edit_title' => 'Editar User',
        'show_title' => 'Visualizar User',
        'inputs' => [
            'name' => 'NOME',
            'email' => 'E-MAIL',
            'password' => 'SENHA',
        ],
    ],
];
