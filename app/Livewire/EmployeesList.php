<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Services\EmployeeService;

class EmployeesList extends Component
{
    public $employees = [];
    protected EmployeeService $employeeService;

    public function boot(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function mount()
    {
        $this->loadEmployees();
    }

    #[On('refreshEmployeesList')]
    public function loadEmployees()
    {
        $this->employees = $this->employeeService->all();
    }

    public function render()
    {
        return view('livewire.employees-list');
    }
}

