<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestGetVendas extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'vendedor' => 'required|exists:vendedores,uuid',
        ];
    }


    public function messages(): array
    {
        return [
            'vendedor.required' => 'O campo vendedor é obrigatório.',
            'vendedor.exists' => 'O vendedor informado não existe.',
        ];
    }


    function validationData(): array
    {
        return array_merge($this->all(), [
            'vendedor' => $this->route('vendedor'),
        ]);
    }
}
