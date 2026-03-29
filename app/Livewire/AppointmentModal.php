<?php

namespace App\Livewire;

use App\Services\AppointmentService;
use App\Services\ClientService;
use App\Services\EmployeeService;
use App\Services\ServiceService;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Attributes\On;

class AppointmentModal extends Component
{
    public $showModal = false;
    public $employee_id, $client_id, $service_id;
    public $optionsEmployees = [];
    public $optionsClients = [];
    public $optionsServices = [];
    public $isEditing = false;

    protected AppointmentService $appointmentService;
    protected ClientService $clientService;
    protected EmployeeService $employeeService;
    protected ServiceService $serviceService;

    public function boot(AppointmentService $appointmentService, ClientService $clientService, EmployeeService $employeeService, ServiceService $serviceService)
    {
        $this->appointmentService = $appointmentService;
        $this->clientService = $clientService;
        $this->employeeService = $employeeService;
        $this->serviceService = $serviceService;
        $this->optionsEmployees = $this->employeeService->all()->pluck('user.name', 'id')->toArray();
        $this->optionsClients   = $this->clientService->all()->pluck('user.name', 'id')->toArray();
        $this->optionsServices  = $this->serviceService->all()->pluck('name', 'id')->toArray();
    }

    #[On('edit-appointment')]
    public function editAppointment($id)
    {
        $appointment = $this->appointmentService->find($id);

        if ($appointment) {
            $this->employee_id = $appointment->employee_id;
            $this->client_id = $appointment->client_id;
            $this->service_id = $appointment->service_id;
            $this->isEditing = true;
            $this->showModal = true;
        }
    }

    protected function rules()
    {
        return [
            'employee_id' => 'required|exists:employees,id',
            'client_id' => 'required|exists:clients,id',
            'service_id' => 'required|exists:services,id',
        ];
    }

    protected function messages()
    {
        return [
            'employee_id.required' => 'O funcionário é obrigatório.',
            'employee_id.exists' => 'O funcionário selecionado não existe.',
            'client_id.required' => 'O cliente é obrigatório.',
            'client_id.exists' => 'O cliente selecionado não existe.',
            'service_id.required' => 'O serviço é obrigatório.',
            'service_id.exists' => 'O serviço selecionado não existe.',
        ];
    }

    public function save()
    {
        try {
            $this->validate($this->rules(), $this->messages());
            $data = [
                'employee_id' => $this->employee_id,
                'client_id' => $this->client_id,
                'service_id' => $this->service_id,
            ];

            if ($this->isEditing) {
                $this->appointmentService->update($this->appointmentId, $data);
                $message = 'Agendamento atualizado com sucesso!';
            } else {
                $this->appointmentService->store($data);
                $message = 'Agendamento criado com sucesso!';
            }

            $this->dispatch('alert', type: 'success', message: $message);
            $this->dispatch('refreshAppointmentsList');
            $this->closeModal();

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'Erro: ' . $e->getMessage());
        }
    }

    public function delete()
    {
        try {
            if (!$this->isEditing || !$this->appointmentId) {
                throw new \Exception('Agendamento não encontrado.');
            }

            $this->appointmentService->delete($this->appointmentId);

            $this->dispatch('alert', type: 'success', message: 'Agendamento excluído com sucesso!');
            $this->dispatch('refreshAppointmentsList');
            $this->closeModal();

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'Erro: ' . $e->getMessage());
        }
    }

    #[On('open-appointment-modal')]
    public function openModal()
    {
        $this->optionsEmployees = $this->employeeService->all()->pluck('user.name', 'id')->toArray();
        $this->optionsClients   = $this->clientService->all()->pluck('user.name', 'id')->toArray();
        $this->optionsServices  = $this->serviceService->all()->pluck('name', 'id')->toArray();
        $this->isEditing = false;
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->cleanFields();
    }

    public function cleanFields()
    {
        $this->reset();
    }

    public function render()
    {
        return view('livewire.appointment-modal');
    }
}
