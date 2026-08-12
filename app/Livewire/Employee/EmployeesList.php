<?php

namespace App\Livewire\Employee;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Contracts\EmployeeServiceInterface;
use Livewire\WithPagination;

class EmployeesList extends Component
{
    use WithPagination;
    public $search = '';


    #[On('search-employees')]
    public function updateSearch($search)
    {
        $this->search = $search;
        $this->resetPage();
    }

    #[On('refreshEmployeesList')]
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.employee.employees-list', [
            'employees' => app(EmployeeServiceInterface::class)->all($this->search, 15),
        ]);
    }
}

