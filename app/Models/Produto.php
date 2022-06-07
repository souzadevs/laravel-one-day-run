<?php

namespace App\Models;

use App\Models\Contracts\IProduto;
use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produto extends Model implements IProduto
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['valor_unitario', 'codigo_barras', 'nome'];

    protected $searchableFields = ['*'];

    public function compraItems()
    {
        return $this->hasMany(CompraPedidoItem::class);
    }
}
