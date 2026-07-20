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
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.user.users-list', [
            'users' => app(UserServiceInterface::class)->all($this->search),
        ]);
}
}

