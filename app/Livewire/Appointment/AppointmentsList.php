<?php

namespace App\Livewire\Appointment;

use App\Contracts\AppointmentServiceInterface;
use Livewire\Component;
use Livewire\Attributes\On;

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
        $this->appointments = app(AppointmentServiceInterface::class)->all();
    }

    public function render()
    {
        return view('livewire.appointment.appointments-list');
    }
}

