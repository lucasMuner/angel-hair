<?php

namespace App\Livewire\Booking;

use App\Contracts\AppointmentServiceInterface;
use App\Contracts\ServiceServiceInterface;
use App\Models\Client;
use App\Models\Service;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.main-layout', ['active' => 'appointments-clients'])]
class ClientBookingWizard extends Component
{
    public int $step = 1;

    public ?int $service_id = null;
    public ?int $employee_id = null;
    public ?string $date = null;
    public ?string $start_time = null;

    public array $availableTimes = [];

    public function mount()
    {
        $this->step = 1;
    }

    public function getServicesProperty()
    {
        return app(ServiceServiceInterface::class)->all();
    }

    public function getEmployeesProperty()
    {
        if (!$this->service_id) {
            return collect();
        }

        return Service::findOrFail($this->service_id)
            ->employees()
            ->with('user')
            ->get();
    }

    public function selectService(int $serviceId)
    {
        $this->service_id = $serviceId;
        $this->employee_id = null;
        $this->date = null;
        $this->start_time = null;
        $this->availableTimes = [];
        $this->step = 2;
    }

    public function selectEmployee(int $employeeId)
    {
        $this->employee_id = $employeeId;
        $this->date = null;
        $this->start_time = null;
        $this->availableTimes = [];
        $this->step = 3;
    }

    public function updatedDate(AppointmentServiceInterface $service)
    {
        $this->start_time = null;

        if (!$this->date || !$this->employee_id || !$this->service_id) {
            return;
        }

        $this->availableTimes = $service->getAvailableTimes(
            $this->employee_id,
            $this->service_id,
            $this->date
        );

        $this->step = 4;
    }

    public function selectTime(string $time)
    {
        $this->start_time = $time;
        $this->step = 5;
    }

    public function backTo(int $step)
    {
        $this->step = $step;
    }

    public function confirm(AppointmentServiceInterface $service)
    {
        $client = Client::where('user_id', Auth::id())->first();

        if (!$client) {
            $this->dispatch('alert', type: 'error', message: 'Perfil de cliente não encontrado.');
            return;
        }

        try {
            $service->store([
                'employee_id' => $this->employee_id,
                'client_id'   => $client->id,
                'service_id'  => $this->service_id,
                'date'        => $this->date,
                'start_time'  => $this->start_time,
            ]);

            $this->reset(['service_id', 'employee_id', 'date', 'start_time', 'availableTimes']);
            $this->step = 6;

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'Erro ao agendar: ' . $e->getMessage());
        }
    }

    public function restart()
    {
        $this->reset(['service_id', 'employee_id', 'date', 'start_time', 'availableTimes']);
        $this->step = 1;
    }

    public function render()
    {
        return view('livewire.booking.client-booking-wizard');
    }
}
