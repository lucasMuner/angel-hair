<?php

namespace App\Services;

use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Contracts\ServiceServiceInterface;

class ServiceService implements ServiceServiceInterface
{

    /**
     * Create new service
     */
    public function store(array $data): Service
    {
        DB::beginTransaction();
        try {
            // Create Service
            $service = new Service();
            $service->name = $data['name'];
            $service->description = $data['description'];
            $service->price = $data['price'];
            $service->duration = $data['duration'];
            $service->saveWithLog();

            DB::commit();

            return $service;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao criar serviço', [
                'error' => $e->getMessage(),
                'data' => $data
            ]);
            throw $e;
        }
    }

    /**
     * Update client
     */
    public function update(int $serviceId, array $data): Service
    {
        DB::beginTransaction();
        try {
            $service = Service::findOrFail($serviceId);

            // Update Service
            $service->name = $data['name'];
            $service->description = $data['description'];
            $service->price = $data['price'];
            $service->duration = $data['duration'];
            $service->saveWithLog();

            DB::commit();

            return $service->fresh();

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao atualizar serviço', [
                'service_id' => $serviceId,
                'error' => $e->getMessage(),
                'data' => $data
            ]);
            throw $e;
        }
    }

    /**
     * Delete service
     */
    public function delete(int $serviceId): bool
    {
        DB::beginTransaction();
        try {
            $service = Service::findOrFail($serviceId);
            $user = $service->user;

            // Delete Service
            $service->deleteWithLog();

            // Delete User
            if ($user) {
                $user->delete();
            }

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao deletar serviço', [
                'service_id' => $serviceId,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    /**
     * Search services by id
     */
    public function find(int $serviceId): ?Service
    {
        return Service::find($serviceId);
    }

    /**
     * List all services with their associated user data
     */
    public function all()
    {
        return Service::latest()->get();
    }
}
