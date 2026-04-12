<?php

namespace App\Contracts;

interface AppointmentServiceInterface
{
    public function store(array $data);
    public function update(int $id, array $data);
    public function delete(int $id): bool;
    public function find(int $id);
    public function all();
    public function getAvailableTimes(int $employeeId, int $serviceId, string $date): array;
}
