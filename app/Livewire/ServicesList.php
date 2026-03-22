<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Services\ServiceService;

class ServicesList extends Component
{
    public $services = [];
    protected ServiceService $serviceService;

    public function boot(ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    public function mount()
    {
        $this->loadServices();
    }

    #[On('refreshServicesList')]
    public function loadServices()
    {
        $this->services = $this->serviceService->all();
    }

    public function render()
    {
        return view('livewire.services-list');
    }
}

