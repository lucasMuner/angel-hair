<?php

namespace App\Livewire\User\Forms;

use Livewire\Form;
use Illuminate\Validation\Rule;

class UserForm extends Form
{
    public $username = '';
    public $name = '';
    public $email = '';
    public $password = '';
    public $role_id = '';
    public $id = null;

    protected function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'name')->ignore($this->id),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->id),
            ],
            'password'=> [
                $this->id ? 'nullable' : 'required',
                'string',
                'min:8',
            ],
            'username'=> [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'username')->ignore($this->id),
            ],
            'role_id' => [
                'required',
                'exists:roles,id',
            ],
        ];
    }

    protected function validationAttributes()
    {
        return [
            'name' => 'nome',
            'email' => 'email',
            'phone' => 'telefone',
            'username' => 'nome de usuário',
            'role_id' => 'função',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'email'    => 'O campo :attribute deve ser um endereço válido.',
            'max'      => 'O campo :attribute não pode ter mais que :max caracteres.',
            'unique'   => 'Este :attribute já está em uso em nosso sistema.',
            'exists'   => 'A :attribute selecionada é inválida.',
        ];
    }
}
