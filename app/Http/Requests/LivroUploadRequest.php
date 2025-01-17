<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LivroUploadRequest extends FormRequest
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
            'capa' => 'required|mimes:jpg,jpeg,png'
        ];
    }

    public function messages(): array
    {
        return [
            'capa.required' => 'Imagem da capa do livro deve ser informada.',
            'capa.mimes' => 'Tipo de arquivo inválido. Selecionar (.jpg, .jpeg, .png)',
        ];
    }
}
