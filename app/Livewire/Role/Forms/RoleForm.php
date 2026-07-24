<?php

namespace App\Livewire\Role\Forms;

use Livewire\Attributes\Validate;
use Illuminate\Validation\Rule;
use Livewire\Form;

class RoleForm extends Form
{
    public $name = '';
    public $description = '';
    public $modules = [];
    public $id = null;

    protected function rules()
    {
        return [
          'name'=> ['required', Rule::unique('roles', 'name')->ignore($this->id)],
          'description'=> ['required'],
          'modules'=> ['required', 'array'],
        ];
    }

    protected function validationAttributes()
    {
        return [
            'name' => 'nome',
            'description' => 'descrição',
            'modules' => 'módulos',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'unique' => 'O campo :attribute já está em uso.',
            'array' => 'O campo :attribute deve ser um array.',
        ];
    }
}
