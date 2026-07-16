<?php

namespace App\Services;

use App\Contracts\RoleServiceInterface;
use App\Contracts\UserServiceInterface;
use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoleService implements RoleServiceInterface
{

    /**
     * Create new employee
     */
    public function store(array $data): Employee
    {
        DB::beginTransaction();
        try {
            // Create User
            $user = $this->userService->storeClientEmployee($data);
            $data['phone'] = \App\Helpers\PhoneHelper::strip($data['phone']);

            $data['services'] = $data['services'] ?? [];

            // Create Employee
            $employee = new Employee();
            $employee->user_id = $user->id;
            $employee->phone = $data['phone'];
            $employee->saveWithLog();

            $employee->services()->sync($data['services']);

            DB::commit();

            return $employee;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao criar funcionário', [
                'error' => $e->getMessage(),
                'data' => $data
            ]);
            throw $e;
        }
    }

    /**
     * Update client
     */
    public function update(int $employeeId, array $data): Employee
    {
        DB::beginTransaction();
        try {
            $employee = Employee::with('user')->findOrFail($employeeId);

            // Update User
            $this->userService->updateClientEmployee($data, $employee->user);
            $data['phone'] = \App\Helpers\PhoneHelper::strip($data['phone']);
            // Update Employee
            $employee->phone = $data['phone'];
            $employee->saveWithLog();

            $employee->services()->sync($data['services']);

            DB::commit();

            return $employee->fresh();

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao atualizar funcionário', [
                'employee_id' => $employeeId,
                'error' => $e->getMessage(),
                'data' => $data
            ]);
            throw $e;
        }
    }

    /**
     * Delete employee
     */
    public function delete(int $employeeId): bool
    {
        DB::beginTransaction();
        try {
            $employee = Employee::with('user')->findOrFail($employeeId);
            $user = $employee->user;

            $employee->services()->detach();
            // Delete Employee
            $employee->deleteWithLog();

            // Delete User
            if ($user) {
                $user->delete();
            }

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao deletar funcionário', [
                'employee_id' => $employeeId,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    /**
     * Search roles by id
     */
    public function find(int $roleId): ?Role
    {
        return Role::with('user')->find($roleId);
    }

    /**
     * List all roles with their associated user data
     */
    public function all()
    {
        return Role::with('user')->latest()->get();
    }
}
