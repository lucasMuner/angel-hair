<?php

namespace App\Livewire\Appointment;

use App\Contracts\AppointmentServiceInterface;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;

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
       $user = Auth::user();

        if ($user->role->name === 'client') {
            $client = Client::where('user_id', $user->id)->first();

            $this->appointments = $client
                ? app(AppointmentServiceInterface::class)->allByClient($client->id)
                : collect();
        } else {
            $this->appointments = app(AppointmentServiceInterface::class)->all();
        }
    }

    public function render()
    {
        return view('livewire.appointment.appointments-list');
    }
}

