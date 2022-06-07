<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompraPedidoItemStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'quantidade' => ['required', 'numeric'],
            'produto_id' => ['required', 'exists:produtos,id'],
            'compra_pedido_id' => ['required', 'exists:compra_pedidos,id'],
        ];
    }
}
