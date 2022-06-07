<?php

namespace App\Models;

use App\Models\Contracts\ICliente;
use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Model implements ICliente
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['nome', 'cpf', 'email'];

    protected $searchableFields = ['*'];

    public function compraPedidos()
    {
        return $this->hasMany(CompraPedido::class);
    }
}
