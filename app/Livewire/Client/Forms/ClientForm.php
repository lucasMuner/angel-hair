<?php

namespace App\Livewire\Client\Forms;

use Livewire\Form;
use Illuminate\Validation\Rule;
use App\Helpers\PhoneHelper;

class ClientForm extends Form
{
    public $phone = '';
    public $userId = null;
    public $birth_date = null;
    public $notes = null;

    protected function rules()
    {
        return [
            'phone' => 'required|string|max:20',
            'userId' => [
                'required',
                Rule::exists('users', 'id'),
            ],
            'birth_date' => 'nullable|date',
            'notes' => 'nullable|string|max:255',
        ];
    }

    protected function validationAttributes()
    {
        return [
            'phone' => 'telefone',
            'userId' => 'usuário',
            'birth_date' => 'aniversário',
            'notes' => 'sobre',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'max'      => 'O campo :attribute não pode ter mais que :max caracteres.',
            'unique'   => 'Este :attribute já está em uso em nosso sistema.',
            'date'     => 'O campo :attribute deve ser uma data válida.',
            'exists'   => 'O :attribute selecionado é inválido.',
        ];
    }
}
