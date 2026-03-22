<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Services\EmployeeService;

class EmployeeModal extends Component
{
    public $showModal = false;
    public $employeeId = null;
    public $userId = null;
    public $name, $email, $phone;
    public $isEditing = false;

    protected EmployeeService $employeeService;

    public function boot(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    #[On('edit-employee')]
    public function editEmployee($id)
    {
        $employee = $this->employeeService->find($id);

        if ($employee) {
            $this->employeeId = $employee->id;
            $this->userId = $employee->user_id;
            $this->name = $employee->user->name;
            $this->email = $employee->user->email;
            $this->phone = $employee->phone;
            $this->isEditing = true;
            $this->showModal = true;
        }
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                $this->isEditing
                    ? 'unique:users,email,' . $this->userId
                    : 'unique:users,email'
            ],
            'phone' => 'required|string|max:20',
        ];
    }

    protected function messages()
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'email.required' => 'O email é obrigatório.',
            'email.email' => 'O email deve ser válido.',
            'email.unique' => 'Este email já está cadastrado.',
            'phone.required' => 'O telefone é obrigatório.',
        ];
    }

    public function save()
    {
        $this->validate();

        try {
            $data = [
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
            ];

            if ($this->isEditing) {
                $this->employeeService->update($this->employeeId, $data);
                $message = 'Funcionário atualizado com sucesso!';
            } else {
                $this->employeeService->store($data);
                $message = 'Funcionário criado com sucesso!';
            }

            $this->dispatch('alert', type: 'success', message: $message);
            $this->dispatch('refreshEmployeesList');
            $this->closeModal();

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'Erro: ' . $e->getMessage());
        }
    }

    public function delete()
    {
        try {
            if (!$this->isEditing || !$this->employeeId) {
                throw new \Exception('Funcionário não encontrado.');
            }

            $this->employeeService->delete($this->employeeId);

            $this->dispatch('alert', type: 'success', message: 'Funcionário excluído com sucesso!');
            $this->dispatch('refreshEmployeesList');
            $this->closeModal();

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'Erro: ' . $e->getMessage());
        }
    }

    public function openModal()
    {
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
        return view('livewire.employee-modal');
    }
}
