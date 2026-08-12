<?php

namespace App\Livewire\Role;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Contracts\RoleServiceInterface;
use Livewire\WithPagination;

class RolesList extends Component
{
    use WithPagination;
    public $search = '';

    #[On('search-roles')]
    public function updateSearch($search)
    {
        $this->search = $search;
        $this->resetPage();
    }

    #[On('refreshRolesList')]
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.role.roles-list', [
            'roles' => app(RoleServiceInterface::class)->all($this->search, 15),
        ]);
    }
}

