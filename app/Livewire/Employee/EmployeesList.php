<?php

namespace App\Livewire\Employee;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Services\EmployeeService;

class EmployeesList extends Component
{
    public $employees = [];

    public function mount()
    {
        $this->loadEmployees();
    }

    #[On('refreshEmployeesList')]
    public function loadEmployees()
    {
        $this->employees = app(EmployeeService::class)->all();
    }

    public function render()
    {
        return view('livewire.employee.employees-list');
    }
}

