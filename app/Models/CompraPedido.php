<?php

namespace App\Models;

use App\Models\Contracts\ICompraPedido;
use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompraPedido extends Model implements ICompraPedido
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'pedido_at',
        'cliente_id',
        'compra_pedido_status_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'compra_pedidos';

    protected $casts = [
        'pedido_at' => 'datetime',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function compraPedidoItems()
    {
        return $this->hasMany(CompraPedidoItem::class);
    }

    public function compraPedidoStatus()
    {
        return $this->belongsTo(CompraPedidoStatus::class);
    }
}
