<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nome do usuário deve ser informado.',
            'email.email' => 'Informe um e-mail válido.',
            'email.required' => 'E-mail do usuário deve ser informado.',
            'email.unique' => 'E-mail já está cadastrado.',
            'password.required' => 'Senha do usuário deve ser informado.',
            'password.confirmed' => 'Confirmação de senha inválido.'
        ];
    }
}
