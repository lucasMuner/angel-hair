<?php

namespace App\Services;

use App\Contracts\ClientServiceInterface;
use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Contracts\UserServiceInterface;

class ClientService implements ClientServiceInterface
{

    protected UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Create new client
     */
    public function store(array $data): Client
    {
        DB::beginTransaction();
        try {
            // Create User
            $user = $this->userService->storeClientEmployee($data);
            $data['phone'] = \App\Helpers\PhoneHelper::strip($data['phone']);
            // Create Client
            $client = new Client();
            $client->user_id = $user->id;
            $client->phone = $data['phone'];
            $client->saveWithLog();

            DB::commit();

            return $client;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao criar cliente', [
                'error' => $e->getMessage(),
                'data' => $data
            ]);
            throw $e;
        }
    }

    /**
     * Update client
     */
    public function update(int $clientId, array $data): Client
    {
        DB::beginTransaction();
        try {
            $client = Client::with('user')->findOrFail($clientId);

            // Update User
            $this->userService->updateClientEmployee($data, $client->user);
            $data['phone'] = \App\Helpers\PhoneHelper::strip($data['phone']);
            // Update Client
            $client->phone = $data['phone'];
            $client->saveWithLog();

            DB::commit();

            return $client->fresh();

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao atualizar cliente', [
                'client_id' => $clientId,
                'error' => $e->getMessage(),
                'data' => $data
            ]);
            throw $e;
        }
    }

    /**
     * Delete client
     */
    public function delete(int $clientId): bool
    {
        DB::beginTransaction();
        try {
            $client = Client::with('user')->findOrFail($clientId);
            $user = $client->user;

            // Delete Client
            $client->deleteWithLog();

            // Delete User
            if ($user) {
                $user->delete();
            }

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao deletar cliente', [
                'client_id' => $clientId,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    /**
     * Search clients by id
     */
    public function find(int $clientId): ?Client
    {
        return Client::with('user')->find($clientId);
    }

    /**
     * List all clients with their associated user data
     */
    public function all()
    {
        return Client::with('user')->latest()->get();
    }

    /**
     * Verify if email already exists (excluding a specific user ID for updates)
     */
    public function emailExists(string $email, ?int $excludeUserId = null): bool
    {
        $query = User::where('email', $email);

        if ($excludeUserId) {
            $query->where('id', '!=', $excludeUserId);
        }

        return $query->exists();
    }
}
