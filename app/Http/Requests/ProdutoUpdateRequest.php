<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProdutoUpdateRequest extends FormRequest
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
                Rule::unique('produtos', 'codigo_barras')->ignore(
                    $this->produto
                ),
                'max:20',
                'string',
            ],
            'nome' => [
                'required',
                Rule::unique('produtos', 'nome')->ignore($this->produto),
                'max:100',
                'string',
            ],
        ];
    }
}
