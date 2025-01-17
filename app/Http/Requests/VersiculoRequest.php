<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VersiculoRequest extends FormRequest
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
            'capitulo' => 'required',
            'versiculo' => 'required',
            'texto' => 'required',
            'livro_id' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'capitulo.required' => 'Capítulo do versiculo deve ser informado.',
            'versiculo.required' => 'Versículo do versiculo deve ser informado.',
            'texto.required' => 'Texto do versiculo deve ser informado.',
            'livro_id.required' => 'Livro do versiculo deve ser informado.'
        ];
    }
}
