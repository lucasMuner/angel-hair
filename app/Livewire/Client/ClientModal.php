<?php

namespace App\Livewire\Client;

use App\Livewire\Base\BaseModal;
use App\Livewire\Client\Forms\ClientForm;
use App\Contracts\ClientServiceInterface;
use Livewire\Attributes\{On, Computed};
use App\Contracts\UserServiceInterface;

class ClientModal extends BaseModal
{
    public ClientForm $form;

    #[On('open-client-modal')]
    public function openModal()
    {
        parent::openModal();

        $this->dispatch('select2-set-values', id: 'userId', values: '');
        $this->dispatch('select2-set-disabled', id: 'userId', disabled: false);
    }

    #[Computed]
    public function optionsUsers()
    {
        return app(UserServiceInterface::class)->all()->pluck('name', 'id')->toArray();
    }

    #[On('edit-client')]
    public function editClient($id, ClientServiceInterface $service)
    {
        if ($client = $service->find($id)) {
            $this->entityId = $client->id;
            $this->form->fill([
                'userId' => $client->user_id,
                'birth_date' => $client->birth_date,
                'notes' => $client->notes,
                'phone'  => !empty($client->phone) ? \App\Helpers\PhoneHelper::format($client->phone) : '',
            ]);
            $this->isEditing = true;
            $this->showModal = true;

            $this->dispatch('select2-set-values', id: 'userId', values: $client->user_id);
            $this->dispatch('select2-set-disabled', id: 'userId', disabled: true);
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
