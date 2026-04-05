<?php

namespace App\Contracts;

interface EmployeeServiceInterface
{
    public function store(array $data);
    public function update(int $id, array $data);
    public function delete(int $id): bool;
    public function find(int $id);
    public function all();
    public function emailExists(string $email, ?int $excludeUserId = null): bool;
}
