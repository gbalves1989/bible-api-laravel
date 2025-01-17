<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestamentoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'required|unique:testamentos|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'Nome do testamento deve ser informado.',
            'nome.unique' => 'Nome do testamento já está cadastrado.'
        ];
    }
}
