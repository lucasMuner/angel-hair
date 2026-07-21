<?php

namespace App\Livewire\User;

use App\Livewire\Base\BaseModal;
use App\Livewire\User\Forms\UserForm;
use App\Contracts\UserServiceInterface;
use Livewire\Attributes\{On,Computed};
use App\Contracts\RoleServiceInterface;

class UserModal extends BaseModal
{
    public UserForm $form;

    #[Computed]
    public function optionsRoles()
    {
        return app(RoleServiceInterface::class)->all()->pluck('name', 'id')->toArray();
    }

    #[On('open-user-modal')]
    public function openModal()
    {
        parent::openModal();

        $this->dispatch('select2-set-values', id: 'role_id', values: '');
    }

    #[On('edit-user')]
    public function editUser($id, UserServiceInterface $service)
    {
        if ($user = $service->find($id)) {
            $this->entityId = $user->id;
            $this->form->fill([
                'id' => $user->id,
                'username' => $user->username ?? '',
                'name'   => $user->name ?? '',
                'email'  => $user->email ?? '',
                'role_id' => $user->role_id ?? ''
            ]);

            $this->dispatch('select2-set-values', id: 'role_id', values: $user->role_id);

            $this->isEditing = true;
            $this->showModal = true;
        }
    }

    public function save(UserServiceInterface $service)
    {
        try {
            $validatedData = $this->form->validate();

            if ($this->isEditing) {
                $service->update($this->entityId, $validatedData);
                $message = 'Usuário atualizado com sucesso!';
            } else {
                $service->store($validatedData);
                $message = 'Usuário criado com sucesso!';
            }

            $this->notify($message, 'refreshUsersList');

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'Erro: ' . $e->getMessage());
        }
    }

    public function delete(UserServiceInterface $service)
    {
        try {
            if (!$this->isEditing || !$this->entityId) {
                throw new \Exception('Usuário não encontrado.');
            }

            $service->delete($this->entityId);
            $this->notify('Usuário deletado com sucesso!', 'refreshUsersList');

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'Erro: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.user.user-modal');
    }
}
