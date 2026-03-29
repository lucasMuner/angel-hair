<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Services\ClientService;

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
        $this->clients = app(ClientService::class)->all();
    }

    public function render()
    {
        return view('livewire.clients-list');
    }
}

