<?php

namespace App\Livewire\Service;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Contracts\ServiceServiceInterface;
use Livewire\WithPagination;

class ServicesList extends Component
{
    use WithPagination;
    public $search = '';

    #[On('search-services')]
    public function updateSearch($search)
    {
        $this->search = $search;
        $this->resetPage();
    }

    #[On('refreshServicesList')]
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.service.services-list', [
            'services' => app(ServiceServiceInterface::class)->all($this->search, 15),
        ]);
    }
}

