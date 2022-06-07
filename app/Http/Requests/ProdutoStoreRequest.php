<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProdutoStoreRequest extends FormRequest
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
            'valor_unitario' => ['required', 'numeric'],
            'codigo_barras' => [
                'required',
                'unique:produtos,codigo_barras',
                'max:20',
                'string',
            ],
            'nome' => ['required', 'unique:produtos,nome', 'max:100', 'string'],
        ];
    }
}
