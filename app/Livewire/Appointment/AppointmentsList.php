<?php

namespace App\Livewire\Appointment;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Services\AppointmentService;

class AppointmentsList extends Component
{
    public $appointments = [];

    public function mount()
    {
        $this->loadAppointments();
    }

    #[On('refreshAppointmentsList')]
    public function loadAppointments()
    {
        $this->appointments = app(AppointmentService::class)->all();
    }

    public function render()
    {
        return view('livewire.appointment.appointments-list');
    }
}

