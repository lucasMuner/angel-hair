<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Services\AppointmentService;

class AppointmentsList extends Component
{
    public $appointments = [];
    protected AppointmentService $appointmentService;

    public function boot(AppointmentService $appointmentService)
    {
        $this->appointmentService = $appointmentService;
    }

    public function mount()
    {
        $this->loadAppointments();
    }

    #[On('refreshAppointmentsList')]
    public function loadAppointments()
    {
        $this->appointments = $this->appointmentService->all();
    }

    public function render()
    {
        return view('livewire.appointments-list');
    }
}

