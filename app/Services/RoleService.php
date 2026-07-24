<?php

namespace App\Services;

use App\Contracts\RoleServiceInterface;
use App\Contracts\UserServiceInterface;
use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class RoleService implements RoleServiceInterface
{

    /**
     * Create new role
     */
    public function store(array $data): Role
    {
        DB::beginTransaction();
        try {
            // Create Role
            $role = new Role();
            $role->name = strtolower($data["name"]);
            $role->description = $data["description"];
            $role->saveWithLog();

            $role->modules()->sync($this->buildModulesSyncData($data['modules']));

            DB::commit();

            return $role;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao criar função', [
                'error' => $e->getMessage(),
                'data' => $data
            ]);
            throw $e;
        }
    }

    /**
     * Update role
     */
    public function update(int $roleId, array $data): Role
    {
        DB::beginTransaction();
        try {
            $role = Role::findOrFail($roleId);

            if(strtolower($role->name) == 'admin') {
                throw new \Exception('Não é possível atualizar a função Admin.');
            }

            // Update Role
            $role->name = strtolower($data["name"]);
            $role->description = $data["description"];
            $role->saveWithLog();

            $role->modules()->sync($this->buildModulesSyncData($data['modules']));

            DB::commit();

            return $role;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao atualizar função', [
                'role_id' => $roleId,
                'error' => $e->getMessage(),
                'data' => $data
            ]);
            throw $e;
        }
    }

    /**
     * Delete role
     */
    public function delete(int $roleId): bool
    {
        DB::beginTransaction();
        try {
            $role = Role::findOrFail($roleId);

            if(strtolower($role->name) == 'admin') {
                throw new \Exception('Não é possível deletar a função Admin.');
            }

            $role->deleteWithLog();

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao deletar função', [
                'role_id' => $roleId,
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
        return Role::find($roleId);
    }

    /**
     * List all roles with their associated user data
     */
    public function all()
    {
        return Role::all();
    }

    private function buildModulesSyncData(array $moduleIds): array
    {
        $userId = Auth::id();

        return collect($moduleIds)->mapWithKeys(fn ($moduleId) => [
            $moduleId => [
                'can_view'         => true,
                'can_create'       => true,
                'can_edit'         => true,
                'can_delete'       => true,
                'user_id_created'  => $userId,
                'user_id_updated'  => $userId,
            ],
        ])->toArray();
    }
}
