<?php

namespace App\Services;

use App\Models\User;
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
            $user->saveWithLog();

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
            $user->saveWithLog();

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
    public function all(?string $search = null, int $perPage = 3)
    {
        return User::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->orderBy('name')
            ->paginate($perPage);
    }

    public function storeClientEmployee (array $data): User
    {
        $generatedUsername = str_replace(' ', '', strtolower($data['name']));
        $existingUser = User::where('username', $generatedUsername)->orWhere('email', $data['email'])->first();

        if ($existingUser) throw new \Exception('O nome de usuário ou email já está em uso por outro usuário.');

        $user = new User();
        $user->username = $generatedUsername;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['name'] . '@' . date('Y'));
        $user->saveWithLog();
        return $user;

    }

    public function updateClientEmployee (array $data, User $user): User
    {
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->username = str_replace(' ', '', strtolower($data['name']));
        $user->saveWithLog();
        return $user;
    }
}
