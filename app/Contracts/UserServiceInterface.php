<?php

namespace App\Contracts;
use App\Models\User;

interface UserServiceInterface
{
    public function store(array $data);
    public function update(int $id, array $data);
    public function delete(int $id): bool;
    public function find(int $id);
    public function all(?string $search = null, int $perPage = 15);
    public function setUserRole(int $userId, string $roleName): User;
}
