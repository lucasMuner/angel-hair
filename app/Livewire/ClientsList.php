<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Services\ClientService;

class ClientsList extends Component
{
    public $clients = [];
    protected ClientService $clientService;

    public function boot(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function mount()
    {
        $this->loadClients();
    }

    #[On('refreshClientsList')]
    public function loadClients()
    {
        $this->clients = $this->clientService->all();
    }

    public function render()
    {
        return view('livewire.clients-list');
    }
}

