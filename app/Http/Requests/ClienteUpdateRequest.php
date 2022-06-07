<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ClienteUpdateRequest extends FormRequest
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
            'nome' => ['required', 'max:255', 'string'],
            'cpf' => [
                'required',
                Rule::unique('clientes', 'cpf')->ignore($this->cliente),
                'max:11',
                'string',
            ],
            'email' => [
                'nullable',
                Rule::unique('clientes', 'email')->ignore($this->cliente),
                'email',
            ],
        ];
    }
}
