<?php

namespace App\Livewire;

use App\Livewire\Forms\AppointmentForm;
use App\Services\AppointmentService;
use App\Services\ClientService;
use App\Services\EmployeeService;
use App\Services\ServiceService;
use Livewire\Attributes\{Computed, On};
use Livewire\Component;

class AppointmentModal extends Component
{

    public AppointmentForm $form;
    public $showModal = false;
    public $appointmentId = null;
    public $isEditing = false;

    #[Computed]
    public function optionsEmployees()
    {
        return app(EmployeeService::class)->all()->pluck('user.name', 'id')->toArray();
    }

    #[Computed]
    public function optionsClients()
    {
        return app(ClientService::class)->all()->pluck('user.name', 'id')->toArray();
    }

    #[Computed]
    public function optionsServices()
    {
        return app(ServiceService::class)->all()->pluck('name', 'id')->toArray();
    }

    #[On('edit-appointment')]
    public function editAppointment($id, AppointmentService $service)
    {
        if ($appointment = $service->find($id)) {
            $this->appointmentId = $id;
            $this->form->fill($appointment->toArray());
            $this->isEditing = true;
            $this->showModal = true;
        }
    }

    public function save(AppointmentService $service)
    {
        try {
            $this->form->validate();
            $post = $this->form->all();

            if ($this->isEditing) {
                $service->update($this->appointmentId, $post);
                $message = 'Agendamento atualizado com sucesso!';
            } else {
                $service->store($post);
                $message = 'Agendamento criado com sucesso!';
            }

            $this->notify($message);

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'Erro: ' . $e->getMessage());
        }
    }

    public function delete()
    {
        try {
            if (!$this->isEditing || !$this->appointmentId) throw new \Exception('Agendamento não encontrado.');

            $this->appointmentService->delete($this->appointmentId);

            $this->notify('Agendamento deletado com sucesso!');

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'Erro: ' . $e->getMessage());
        }
    }

    private function notify($message)
    {
        $this->dispatch('alert', type: 'success', message: $message);
        $this->dispatch('refreshAppointmentsList');
        $this->closeModal();
    }

    #[On('open-appointment-modal')]
    public function openModal()
    {
        $this->cleanFields();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function cleanFields()
    {
        $this->reset(['appointmentId', 'isEditing']);
        $this->form->reset();
    }

    public function render()
    {
        return view('livewire.appointment-modal');
    }
}
