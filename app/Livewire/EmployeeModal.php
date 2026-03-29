<?php

namespace App\Livewire;

use App\Livewire\Forms\EmployeeForm;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Services\EmployeeService;

class EmployeeModal extends Component
{
    public EmployeeForm $form;
    public $showModal = false;
    public $employeeId = null;
    public $userId = null;
    public $isEditing = false;

    #[On('edit-employee')]
    public function editEmployee($id, EmployeeService $service)
    {
        if ($employee = $service->find($id)) {
            $this->employeeId = $employee->id;
            $this->form->fill([
                'userId' => $employee->user_id,
                'name'  => $employee->user->name ?? '',
                'email' => $employee->user->email ?? '',
                'phone'  => \App\Helpers\PhoneHelper::format($employee->phone) ?? '',
            ]);
            $this->isEditing = true;
            $this->showModal = true;
        }
    }

    public function save(EmployeeService $service)
    {
        try {
            $validatedData = $this->form->validate();

            if (!empty($validatedData['phone'])) {
                $validatedData['phone'] = \App\Helpers\PhoneHelper::strip($validatedData['phone']);
            }
            if ($this->isEditing) {
                $service->update($this->employeeId, $validatedData);
                $message = 'Funcionário atualizado com sucesso!';
            } else {
                $service->store($validatedData);
                $message = 'Funcionário criado com sucesso!';
            }

            $this->notify($message);

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'Erro: ' . $e->getMessage());
        }
    }

    public function delete(EmployeeService $service)
    {
        try {
            if (!$this->isEditing || !$this->employeeId) throw new \Exception('Funcionário não encontrado.');

            $service->delete($this->employeeId);

            $this->notify('Funcionário deletado com sucesso!');

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'Erro: ' . $e->getMessage());
        }
    }

    public function notify($message)
    {
        $this->dispatch('alert', type: 'success', message: $message);
        $this->dispatch('refreshEmployeesList');
        $this->closeModal();
    }

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->cleanFields();
        $this->showModal = false;

    }

    public function cleanFields()
    {
        $this->reset(['employeeId', 'userId', 'isEditing']);
        $this->form->reset();
    }

    public function render()
    {
        return view('livewire.employee-modal');
    }
}
