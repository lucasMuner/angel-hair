<?php

namespace App\Livewire\Service\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Validation\Rule;

class ServiceForm extends Form
{
    public $serviceId = null; // Guardamos o ID aqui para o ignore
    public $name = '';
    public $description = '';
    public $price = '';
    public $duration = '';

    // Regras dinâmicas
    protected function rules()
    {
        return [
            'name' => [
                'required',
                // Ignora o ID atual se ele existir
                Rule::unique('services', 'name')->ignore($this->serviceId),
            ],
            'description' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:30',
        ];
    }

    protected function validationAttributes()
    {
        return [
            'name' => 'nome',
            'description' => 'descrição',
            'price' => 'preço',
            'duration' => 'duração',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O :attribute é obrigatório.',
            'numeric' => 'O :attribute deve ser um número válido.',
            'min' => 'O :attribute deve ser um valor positivo.',
            'unique' => 'Este :attribute já está cadastrado.',
            'max' => 'O :attribute deve ter no máximo :max caracteres.',
        ];
    }
}
