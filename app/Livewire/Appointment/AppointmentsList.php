<?php

namespace App\Livewire\Appointment;

use App\Contracts\AppointmentServiceInterface;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class AppointmentsList extends Component
{
    use WithPagination;
    public $search = '';

    #[On('search-appointments')]
    public function updateSearch($search)
    {
        $this->search = $search;
        $this->resetPage();
    }

    #[On('refreshAppointmentsList')]
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.appointment.appointments-list', [
            'appointments' => app(AppointmentServiceInterface::class)->all($this->search, 15),
        ]);
    }
}

