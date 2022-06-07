<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Contracts\ICompraPedidoStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompraPedidoStatus extends Model implements ICompraPedidoStatus
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['descricao', 'cor_fundo_hex', 'cor_texto_hex'];

    protected $searchableFields = ['*'];

    protected $table = 'compra_pedido_statuses';

    public function compraPedidos()
    {
        return $this->hasMany(CompraPedido::class);
    }
}
