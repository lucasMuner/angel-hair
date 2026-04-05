<?php

namespace App\Livewire\Employee\Forms;

use Livewire\Attributes\Validate;
use Illuminate\Validation\Rule;
use Livewire\Form;

class EmployeeForm extends Form
{
    public $name = '';
    public $email = '';
    public $phone = '';
    public $userId = null;

    protected function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'username')->ignore($this->userId),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->userId),
            ],
            'phone' => 'required|string|max:20'
        ];
    }

    protected function validationAttributes()
    {
        return [
            'name' => 'nome',
            'email' => 'email',
            'phone' => 'telefone',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'email'    => 'O campo :attribute deve ser um endereço válido.',
            'max'      => 'O campo :attribute não pode ter mais que :max caracteres.',
            'unique'   => 'Este :attribute já está em uso em nosso sistema.',
        ];
    }
}
