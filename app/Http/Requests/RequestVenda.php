<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestVenda extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'vendedor' => 'required|exists:vendedores,uuid',
            'valor' => 'required|numeric|min:0.01',
        ];
    }

    public function messages()
    {
        return [
            'vendedor.required' => 'O campo vendedor é obrigatório.',
            'vendedor.exists' => 'O vendedor informado não existe.',
            'valor.required' => 'O campo valor é obrigatório.',
            'valor.numeric' => 'O valor deve ser numérico.',
            'valor.min' => 'O valor deve ser maior que 0.',

        ];
    }
}
