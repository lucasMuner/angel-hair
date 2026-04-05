<?php

namespace App\Livewire\Client;

use App\Livewire\Base\BaseModal;
use App\Livewire\Client\Forms\ClientForm;
use App\Contracts\ClientServiceInterface;
use Livewire\Attributes\On;

class ClientModal extends BaseModal
{
    public ClientForm $form;

    #[On('open-client-modal')]
    public function openModal()
    {
        parent::openModal();
    }

    #[On('edit-client')]
    public function editClient($id, ClientServiceInterface $service)
    {
        if ($client = $service->find($id)) {
            $this->entityId = $client->id;
            $this->form->fill([
                'userId' => $client->user_id,
                'name'   => $client->user->name ?? '',
                'email'  => $client->user->email ?? '',
                'phone'  => \App\Helpers\PhoneHelper::format($client->phone) ?? '',
            ]);
            $this->isEditing = true;
            $this->showModal = true;
        }
    }

    public function save(ClientServiceInterface $service)
    {
        try {
            $validatedData = $this->form->validate();

            if ($this->isEditing) {
                $service->update($this->entityId, $validatedData);
                $message = 'Cliente atualizado com sucesso!';
            } else {
                $service->store($validatedData);
                $message = 'Cliente criado com sucesso!';
            }

            $this->notify($message, 'refreshClientsList');

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'Erro: ' . $e->getMessage());
        }
    }

    public function delete(ClientServiceInterface $service)
    {
        try {
            if (!$this->isEditing || !$this->entityId) {
                throw new \Exception('Cliente não encontrado.');
            }

            $service->delete($this->entityId);
            $this->notify('Cliente deletado com sucesso!', 'refreshClientsList');

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'Erro: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.client.client-modal');
    }
}
