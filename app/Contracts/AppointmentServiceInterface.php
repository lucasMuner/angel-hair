<?php

namespace App\Contracts;

interface AppointmentServiceInterface
{
    public function store(array $data);
    public function update(int $id, array $data);
    public function delete(int $id): bool;
    public function find(int $id);
    public function all(?string $search = null, ?int $perPage = null);
    public function allByClient(int $clientId);
    public function getAvailableTimes(int $employeeId, int $serviceId, string $date, ?int $excludeId = null): array;
}
