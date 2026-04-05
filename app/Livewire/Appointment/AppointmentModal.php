<?php

namespace App\Livewire\Appointment;

use App\Livewire\Appointment\Forms\AppointmentForm;
use App\Contracts\AppointmentServiceInterface;
use App\Contracts\ClientServiceInterface;
use App\Contracts\EmployeeServiceInterface;
use App\Contracts\ServiceServiceInterface;
use Livewire\Attributes\{Computed, On};
use App\Livewire\Base\BaseModal;

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
        return app(ServiceServiceInterface::class)->all()->pluck('name', 'id')->toArray();
    }

    #[On('open-appointment-modal')]
    public function openModal()
    {
        $this->cleanFields(); // esse modal limpava no open, mantendo o comportamento
        parent::openModal();
    }

    #[On('edit-appointment')]
    public function editAppointment($id, AppointmentServiceInterface $service)
    {
        if ($appointment = $service->find($id)) {
            $this->entityId = $appointment->id;
            $this->form->fill($appointment->toArray());
            $this->isEditing = true;
            $this->showModal = true;
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

    public function render()
    {
        return view('livewire.appointment.appointment-modal');
    }
}
