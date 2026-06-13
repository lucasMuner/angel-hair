<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255', 'nullable'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'password' => ['required', 'string', 'min:8'],
            'email' => ['string', 'email', 'max:255', 'unique:users,email', 'nullable'],
            'phone' => ['string', 'max:20', 'nullable'],
            'date_of_birth' => ['date', 'before:today', 'nullable']
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'O campo de nome deve ser uma string.',
            'name.max' => 'O campo de nome não pode exceder 255 caracteres.',
            'username.required' => 'O campo de usuário é obrigatório.',
            'username.unique' => 'Este nome de usuário já está em uso.',
            'password.required' => 'O campo de senha é obrigatório.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
            'email.email' => 'O campo de email deve ser um endereço de email válido.',
            'email.unique' => 'Este email já está registrado.',
            'phone.nullable' => 'O campo de telefone é opcional.',
            'date_of_birth.date' => 'O campo de data de nascimento deve ser uma data válida.',
            'date_of_birth.before' => 'A data de nascimento deve ser anterior a hoje.'
        ];
    }
}
