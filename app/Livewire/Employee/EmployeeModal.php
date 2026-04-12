<?php

namespace App\Livewire\Employee;

use App\Livewire\Employee\Forms\EmployeeForm;
use App\Contracts\EmployeeServiceInterface;
use App\Contracts\ServiceServiceInterface;
use Livewire\Attributes\{On, Computed};
use App\Livewire\Base\BaseModal;

class EmployeeModal extends BaseModal
{
    public EmployeeForm $form;

    #[On('open-employee-modal')]
    public function openModal()
    {
        parent::openModal();
    }

    #[Computed]
    public function optionsServices()
    {
        return app(ServiceServiceInterface::class)->all()->pluck('name', 'id')->toArray();
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
                'services' => $employee->services->pluck('id')->toArray(),
                'phone'  => \App\Helpers\PhoneHelper::format($employee->phone) ?? '',
            ]);
            $this->isEditing = true;
            $this->showModal = true;

            $this->dispatchSelect2SetValues('services', $employee->services->pluck('id')->toArray());
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
