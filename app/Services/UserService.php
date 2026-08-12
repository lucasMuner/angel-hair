<?php

namespace App\Services;

use App\Models\User;
use App\Models\Role;
use App\Models\Client;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Contracts\UserServiceInterface;

class UserService implements UserServiceInterface
{

    /**
     * Create new user
     */
    public function store(array $data): User
    {
        DB::beginTransaction();
        try {
            $user = new User();
            $user->username = strtolower($data["username"]);
            $user->name = $data["name"];
            $user->email = $data["email"];
            $user->password = bcrypt($data["password"]);
            $user->role_id = $data["role_id"];
            $user->saveWithLog();

            $this->updateRoleUser($user->id, $data["role_id"]);

            DB::commit();

            return $user;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao criar usuário', [
                'error' => $e->getMessage(),
                'data' => $data
            ]);
            throw $e;
        }
    }

    /**
     * Update user
     */
    public function update(int $userId, array $data): User
    {
        DB::beginTransaction();
        try {
            $user = User::findOrFail($userId);

            // Update User
            $user->username = strtolower($data["username"]);
            $user->name = $data["name"];
            $user->email = $data["email"];
            $user->role_id = $data["role_id"];
            $user->saveWithLog();

            $this->updateRoleUser($userId, $data["role_id"]);

            DB::commit();

            return $user;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao atualizar usuário', [
                'user_id' => $userId,
                'error' => $e->getMessage(),
                'data' => $data
            ]);
            throw $e;
        }
    }

    /**
     * Delete user
     */
    public function delete(int $userId): bool
    {
        DB::beginTransaction();
        try {
            $user = User::findOrFail($userId);

            if(strtolower($user->name) == 'admin') {
                throw new \Exception('Não é possível deletar o usuário Admin.');
            }

            $user->deleteWithLog();

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao deletar usuário', [
                'user_id' => $userId,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    /**
     * Search users by id
     */
    public function find(int $userId): ?User
    {
        return User::find($userId);
    }

    /**
     * List all users with their associated data
     */
    public function all(?string $search = null, ?int $perPage = null)
    {
        $query = User::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->orderBy('name');

        if($perPage !== null) {
            return $query->paginate($perPage);
        }

        return $query->get();
    }

    public function setUserRole(int $userId, string $roleName): User
    {
        $role = Role::where('name', $roleName)->first();

        if (!$role) {
            throw new \Exception("Role '{$roleName}' não encontrada.");
        }

        $user = User::findOrFail($userId);
        $user->role_id = $role->id;
        $user->saveWithLog();

        return $user;
    }

    private function updateRoleUser(int $userId, int $roleId)
    {
        $role = Role::find($roleId);

        if($role){
            if(strtolower($role->name) == 'client') {
                // Save the user as a client
                $isClient = Client::where('user_id',  $userId)->exists();
                $isEmployee = Employee::where('user_id', $userId)->exists();

                if($isEmployee) throw new \Exception('O usuário já está associado a um funcionário. Não é possível associar a um cliente.');

                if(!$isClient) {
                    $client = new Client();
                    $client->user_id = $userId;
                    $client->saveWithLog();
                }
            } else if (strtolower($role->name) == 'employee') {
                // Save the user as an employee
                $isEmployee = Employee::where('user_id', $userId)->exists();
                $isClient = Client::where('user_id',  $userId)->exists();

                if($isClient) throw new \Exception('O usuário já está associado a um cliente. Não é possível associar a um funcionário.');

                if(!$isEmployee) {
                    $employee = new Employee();
                    $employee->user_id = $userId;
                    $employee->saveWithLog();
                }
            }
        } else {
            $isEmployee = Employee::where('user_id', $userId)->first();
            if($isEmployee) {
                $isEmployee->delete();
            }

            $isClient = Client::where('user_id', $userId)->first();
            if($isClient) {
                $isClient->delete();
            }
        }
    }

}
