<?php

namespace App\Livewire\Service;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Contracts\ServiceServiceInterface;

class ServicesList extends Component
{
    public $services = [];

    public function mount()
    {
        $this->loadServices();
    }

    #[On('refreshServicesList')]
    public function loadServices()
    {
        $this->services = app(ServiceServiceInterface::class)->all();
    }

    public function render()
    {
        return view('livewire.service.services-list');
    }
}

