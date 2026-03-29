<?php

namespace App\Livewire;

use App\Livewire\Forms\ClientForm;
use App\Models\Client;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Services\ClientService;

class ClientModal extends Component
{

    public ClientForm $form;
    public $showModal = false;
    public $clientId = null;
    public $userId = null;
    public $isEditing = false;

    #[On('edit-client')]
    public function editClient($id, ClientService $service)
    {
        if ($client = $service->find($id)) {
            $this->clientId = $client->id;
            $this->form->fill([
                'userId' => $client->user_id,
                'name'  => $client->user->name ?? '',
                'email' => $client->user->email ?? '',
                'phone'  => \App\Helpers\PhoneHelper::format($client->phone) ?? '',
            ]);
            $this->isEditing = true;
            $this->showModal = true;
        }
    }

    public function save(ClientService $service)
    {
        try {
            $validatedData = $this->form->validate();

            if (!empty($validatedData['phone'])) {
                $validatedData['phone'] = \App\Helpers\PhoneHelper::strip($validatedData['phone']);
            }

            if ($this->isEditing) {
                $service->update($this->clientId, $validatedData);
                $message = 'Cliente atualizado com sucesso!';
            } else {
                $service->store($validatedData);
                $message = 'Cliente criado com sucesso!';
            }

            $this->notify($message);

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'Erro: ' . $e->getMessage());
        }
    }

    public function delete(ClientService $service)
    {
        try {
            if (!$this->isEditing || !$this->clientId) throw new \Exception('Cliente não encontrado.');

            $service->delete($this->clientId);

            $this->notify('Cliente deletado com sucesso!');

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'Erro: ' . $e->getMessage());
        }
    }

    private function notify($message)
    {
        $this->dispatch('alert', type: 'success', message: $message);
        $this->dispatch('refreshClientsList');
        $this->closeModal();
    }

    #[On('open-client-modal')]
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
        $this->reset(['clientId', 'userId', 'isEditing']);
        $this->form->reset();
    }

    public function render()
    {
        return view('livewire.client-modal');
    }
}
