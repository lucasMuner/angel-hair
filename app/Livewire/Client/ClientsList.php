<?php

namespace App\Livewire\Client;

use App\Contracts\ClientServiceInterface;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class ClientsList extends Component
{
    use WithPagination;
    public $search = '';

    #[On('search-clients')]
    public function updateSearch($search)
    {
        $this->search = $search;
        $this->resetPage();
    }

    #[On('refreshClientsList')]
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.client.clients-list', [
            'clients' => app(ClientServiceInterface::class)->all($this->search, 15),
        ]);
    }
}

