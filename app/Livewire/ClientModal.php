<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Services\ClientService;

class ClientModal extends Component
{
    public $showModal = false;
    public $clientId = null;
    public $userId = null;
    public $name, $email, $phone;
    public $isEditing = false;

    protected ClientService $clientService;

    public function boot(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    #[On('edit-client')]
    public function editClient($id)
    {
        $client = $this->clientService->find($id);

        if ($client) {
            $this->clientId = $client->id;
            $this->userId = $client->user_id;
            $this->name = $client->user->name;
            $this->email = $client->user->email;
            $this->phone = $client->phone;
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
                $this->clientService->update($this->clientId, $data);
                $message = 'Cliente atualizado com sucesso!';
            } else {
                $this->clientService->store($data);
                $message = 'Cliente criado com sucesso!';
            }

            $this->dispatch('alert', type: 'success', message: $message);
            $this->dispatch('refreshClientsList');

            $this->cleanFields();
            $this->closeModal();

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'Erro: ' . $e->getMessage());
        }
    }

    public function delete()
    {
        try {
            if (!$this->isEditing || !$this->clientId) {
                throw new \Exception('Cliente não encontrado.');
            }

            $this->clientService->delete($this->clientId);

            $this->dispatch('alert', type: 'success', message: 'Cliente excluído com sucesso!');
            $this->dispatch('refreshClientsList');

            $this->cleanFields();
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
        return view('livewire.client-modal');
    }
}
