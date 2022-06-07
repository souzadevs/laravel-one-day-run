<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompraPedidoStatusStoreRequest extends FormRequest
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
            'descricao' => ['required', 'max:255', 'string'],
            'cor_fundo_hex' => ['required', 'max:255', 'string'],
            'cor_texto_hex' => ['required', 'max:255', 'string'],
        ];
    }
}
