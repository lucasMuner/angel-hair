<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use App\Contracts\UserServiceInterface;

class UsersList extends Component
{
    use WithPagination;

    public $search = '';

    #[On('refreshUsersList')]
    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[On('request-export')]
    public function requestExport()
    {
        $this->dispatch('export-users', search: $this->search);
    }

    public function render()
    {
        return view('livewire.user.users-list', [
            'users' => app(UserServiceInterface::class)->all($this->search),
        ]);
    }
}

