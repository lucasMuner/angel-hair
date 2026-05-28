<?php

namespace App\Livewire\Appointment;

use App\Livewire\Appointment\Forms\AppointmentForm;
use App\Contracts\AppointmentServiceInterface;
use App\Contracts\ClientServiceInterface;
use App\Contracts\EmployeeServiceInterface;
use App\Contracts\ServiceServiceInterface;
use Livewire\Attributes\{Computed, On};
use App\Livewire\Base\BaseModal;
use App\Models\Employee;

class AppointmentModal extends BaseModal
{
    public AppointmentForm $form;

    #[Computed]
    public function optionsEmployees()
    {
        return app(EmployeeServiceInterface::class)->all()->pluck('user.name', 'id')->toArray();
    }

    #[Computed]
    public function optionsClients()
    {
        return app(ClientServiceInterface::class)->all()->pluck('user.name', 'id')->toArray();
    }

    #[Computed]
    public function optionsServices()
    {
        if (!$this->form->employee_id) return [];
        return Employee::find($this->form->employee_id)->services()->pluck('services.name', 'services.id')->toArray();
    }

    #[On('open-appointment-modal')]
    public function openModal()
    {
        $this->cleanFields();
        parent::openModal();

        $this->dispatch('select2-set-values', id: 'employee_id', values: '');
        $this->dispatch('select2-set-values', id: 'client_id', values: '');
    }

    #[On('edit-appointment')]
    public function editAppointment($id, AppointmentServiceInterface $service)
    {
        if ($appointment = $service->find($id)) {
            $this->entityId = $appointment->id;
            $this->form->fill($appointment->toArray());
            $this->isEditing = true;
            $this->showModal = true;

            $this->form->availableTimes = $service->getAvailableTimes(
                $appointment->employee_id,
                $appointment->service_id,
                $appointment->date,
                $appointment->id
            );

            $this->dispatch('select2-set-values', id: 'employee_id', values: $appointment->employee_id);
            $this->dispatch('select2-set-values', id: 'client_id', values: $appointment->client_id);
        }
    }

    #[On('filter-services')]
    public function filterServices($employeeId)
    {
        $this->form->employee_id = $employeeId;
        $this->form->service_id = null;
    }

    #[On('search-availability')]
    public function searchAvailability(AppointmentServiceInterface $service)
    {
        try {
            $this->form->validateOnly('date');

            $this->form->availableTimes = $service->getAvailableTimes(
                $this->form->employee_id,
                $this->form->service_id,
                $this->form->date,
                $this->isEditing ? $this->entityId : null
            );

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'Erro: ' . $e->getMessage());
        }
    }

    public function save(AppointmentServiceInterface $service)
    {
        try {
            $this->form->validate();
            $post = $this->form->all();

            if ($this->isEditing) {
                $service->update($this->entityId, $post);
                $message = 'Agendamento atualizado com sucesso!';
            } else {
                $service->store($post);
                $message = 'Agendamento criado com sucesso!';
            }

            $this->notify($message, 'refreshAppointmentsList');

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'Erro: ' . $e->getMessage());
        }
    }

    public function delete(AppointmentServiceInterface $service)
    {
        try {
            if (!$this->isEditing || !$this->entityId) {
                throw new \Exception('Agendamento não encontrado.');
            }

            $service->delete($this->entityId);
            $this->notify('Agendamento deletado com sucesso!', 'refreshAppointmentsList');

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'Erro: ' . $e->getMessage());
        }
    }

    public function updatedFormEmployeeId()
    {
        $this->form->service_id = null;
        $this->form->date = null;
        $this->form->start_time = null;
        $this->form->availableTimes = null;
    }

    public function updatedFormClientId()
    {
        $this->form->service_id = null;
        $this->form->date = null;
        $this->form->start_time = null;
        $this->form->availableTimes = null;
    }

    public function updatedFormServiceId()
    {
        $this->form->date = null;
        $this->form->start_time = null;
        $this->form->availableTimes = null;
    }

    public function updatedFormDate()
    {
        $this->form->start_time = null;
        $this->form->availableTimes = null;
    }

    public function render()
    {
        return view('livewire.appointment.appointment-modal');
    }
}
