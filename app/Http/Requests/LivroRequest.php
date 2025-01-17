<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LivroRequest extends FormRequest
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
            'nome' => 'required|max:255',
            'posicao' => 'required',
            'abreviacao' => 'required',
            'testamento_id' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'Nome do livro deve ser informado.',
            'posicao.required' => 'Posição do livro deve ser informado.',
            'abreviacao.required' => 'Abreviação do livro deve ser informado.',
            'testamento_id.required' => 'Testamento do livro deve ser informado.'
        ];
    }
}
