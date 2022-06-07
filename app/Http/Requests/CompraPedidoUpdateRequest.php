<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompraPedidoUpdateRequest extends FormRequest
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
            'pedido_at' => ['required', 'date'],
            'cliente_id' => ['required', 'exists:clientes,id'],
            'compra_pedido_status_id' => [
                'required',
                'exists:compra_pedido_statuses,id',
            ],
        ];
    }
}
