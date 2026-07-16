<?php

namespace App\Livewire\Employee;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Contracts\RoleServiceInterface;

class RolesList extends Component
{
    public $roles = [];

    public function mount()
    {
        $this->loadRoles();
    }

    #[On('refreshRolesList')]
    public function loadRoles()
    {
        $this->roles = app(RoleServiceInterface::class)->all();
    }

    public function render()
    {
        return view('livewire.role.roles-list');
    }
}

