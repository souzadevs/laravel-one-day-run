<?php

namespace App\Models;

use App\Models\Contracts\ICompraPedidoItem;
use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompraPedidoItem extends Model implements ICompraPedidoItem
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['quantidade', 'produto_id', 'compra_pedido_id'];

    protected $searchableFields = ['*'];

    protected $table = 'compra_pedido_items';

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public function compraPedido()
    {
        return $this->belongsTo(CompraPedido::class);
    }
}
