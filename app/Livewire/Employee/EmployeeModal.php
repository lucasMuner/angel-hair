<?php

namespace App\Livewire\Employee;

use App\Livewire\Employee\Forms\EmployeeForm;
use App\Contracts\EmployeeServiceInterface;
use Livewire\Attributes\On;
use App\Livewire\Base\BaseModal;

class EmployeeModal extends BaseModal
{
    public EmployeeForm $form;

    #[On('open-employee-modal')]
    public function openModal()
    {
        parent::openModal();
    }

    #[On('edit-employee')]
    public function editEmployee($id, EmployeeServiceInterface $service)
    {
        if ($employee = $service->find($id)) {
            $this->entityId = $employee->id;
            $this->form->fill([
                'userId' => $employee->user_id,
                'name'   => $employee->user->name ?? '',
                'email'  => $employee->user->email ?? '',
                'phone'  => \App\Helpers\PhoneHelper::format($employee->phone) ?? '',
            ]);
            $this->isEditing = true;
            $this->showModal = true;
        }
    }

    public function save(EmployeeServiceInterface $service)
    {
        try {
            $validatedData = $this->form->validate();

            if ($this->isEditing) {
                $service->update($this->entityId, $validatedData);
                $message = 'Funcionário atualizado com sucesso!';
            } else {
                $service->store($validatedData);
                $message = 'Funcionário criado com sucesso!';
            }

            $this->notify($message, 'refreshEmployeesList');

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'Erro: ' . $e->getMessage());
        }
    }

    public function delete(EmployeeServiceInterface $service)
    {
        try {
            if (!$this->isEditing || !$this->entityId) {
                throw new \Exception('Funcionário não encontrado.');
            }

            $service->delete($this->entityId);
            $this->notify('Funcionário deletado com sucesso!', 'refreshEmployeesList');

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'Erro: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.employee.employee-modal');
    }
}
