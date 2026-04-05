<?php

namespace App\Livewire\Client;

use App\Contracts\ClientServiceInterface;
use Livewire\Component;
use Livewire\Attributes\On;

class ClientsList extends Component
{
    public $clients = [];

    public function mount()
    {
        $this->loadClients();
    }

    #[On('refreshClientsList')]
    public function loadClients()
    {
        $this->clients = app(ClientServiceInterface::class)->all();
    }

    public function render()
    {
        return view('livewire.client.clients-list');
    }
}

