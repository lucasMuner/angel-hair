<?php

namespace App\Livewire\Employee\Forms;

use Livewire\Attributes\Validate;
use Illuminate\Validation\Rule;
use Livewire\Form;

class EmployeeForm extends Form
{
    public $phone = '';
    public $userId = '';
    public $hire_date = '';
    public $services = [];

    protected function rules()
    {
        return [
            'phone' => 'required|string|max:20',
            'services' => 'array',
            'services.*' => 'exists:services,id',
            'userId' => [
                'required',
                Rule::exists('users', 'id'),
            ],
            'hire_date' => 'nullable|date',
        ];
    }

    protected function validationAttributes()
    {
        return [
            'phone' => 'telefone',
            'services' => 'serviços',
            'userId' => 'usuário',
            'hire_date' => 'data de contratação',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'max'      => 'O campo :attribute não pode ter mais que :max caracteres.',
            'unique'   => 'Este :attribute já está em uso em nosso sistema.',
            'exists'   => 'O :attribute selecionado é inválido.',
            'date'     => 'O campo :attribute deve ser uma data válida.',
        ];
    }
}
