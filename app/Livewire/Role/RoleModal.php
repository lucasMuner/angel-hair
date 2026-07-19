<?php

namespace App\Livewire\Role;

use App\Models\Role;
use App\Livewire\Role\Forms\RoleForm;
use App\Contracts\RoleServiceInterface;
use Livewire\Attributes\{On, Computed};
use App\Livewire\Base\BaseModal;

class RoleModal extends BaseModal
{
    public RoleForm $form;

    #[On('open-role-modal')]
    public function openModal()
    {
        parent::openModal();
    }

    #[On('edit-role')]
    public function editRole($id, RoleServiceInterface $service)
    {
        if ($role = $service->find($id)) {
            $this->entityId = $role->id;
            $this->form->fill([
                'id' => $role->id,
                'name' => $role->name,
                'description' => $role->description,
            ]);

            $this->isEditing = true;
            $this->showModal = true;
        }
    }

    public function save(RoleServiceInterface $service)
    {
        try {
            $validatedData = $this->form->validate();

            if ($this->isEditing) {
                $service->update($this->entityId, $validatedData);
                $message = 'Função atualizada com sucesso!';
            } else {
                $service->store($validatedData);
                $message = 'Função criada com sucesso!';
            }

            $this->notify($message, 'refreshRolesList');

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'Erro: ' . $e->getMessage());
        }
    }

    public function delete(RoleServiceInterface $service)
    {
        try {
            if (!$this->isEditing || !$this->entityId) {
                throw new \Exception('Função não encontrada.');
            }

            $service->delete($this->entityId);
            $this->notify('Função deletada com sucesso!', 'refreshRolesList');

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'Erro: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.role.role-modal');
    }
}
