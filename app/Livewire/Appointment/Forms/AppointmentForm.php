<?php

namespace App\Livewire\Appointment\Forms;

use Livewire\Form;
use Livewire\Attributes\Validate;

class AppointmentForm extends Form
{
    #[Validate('required|exists:employees,id', as: 'funcionário')]
    public $employee_id = '';

    #[Validate('required|exists:clients,id', as: 'cliente')]
    public $client_id = '';

    #[Validate('required|exists:services,id', as: 'serviço')]
    public $service_id = '';

    protected function messages()
    {
        return [
            'required' => 'O :attribute é obrigatório.',
            'exists' => 'O :attribute selecionado é inválido.',
        ];
    }
}
