<?php

namespace App\Livewire\Employee;

use App\Livewire\Employee\Forms\EmployeeForm;
use App\Contracts\EmployeeServiceInterface;
use App\Contracts\ServiceServiceInterface;
use App\Contracts\UserServiceInterface;
use Livewire\Attributes\{On, Computed};
use App\Livewire\Base\BaseModal;

class EmployeeModal extends BaseModal
{
    public EmployeeForm $form;

    #[On('open-employee-modal')]
    public function openModal()
    {
        parent::openModal();

        $this->dispatchSelect2SetValues('services', []);
        $this->dispatch('select2-set-disabled', id: 'userId', disabled: false);
    }

    #[Computed]
    public function optionsServices()
    {
        return app(ServiceServiceInterface::class)->all()->pluck('name', 'id')->toArray();
    }

    #[Computed]
    public function optionsUsers()
    {
        return app(UserServiceInterface::class)->all()->pluck('module_name AS name', 'id')->toArray();
    }

    #[On('edit-employee')]
    public function editEmployee($id, EmployeeServiceInterface $service)
    {
        if ($employee = $service->find($id)) {
            $this->entityId = $employee->id;
            $this->form->fill([
                'userId' => $employee->user_id,
                'hire_date' => $employee->hire_date,
                'services' => $employee->services->pluck('id')->toArray(),
                'phone'  => !empty($employee->phone) ? \App\Helpers\PhoneHelper::format($employee->phone) : '',
            ]);
            $this->isEditing = true;
            $this->showModal = true;

            $this->dispatchSelect2SetValues('services', $employee->services->pluck('id')->toArray());
            $this->dispatch('select2-set-values', id: 'userId', values: $employee->user_id);

            $this->dispatch('select2-set-disabled', id: 'userId', disabled: true);
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
