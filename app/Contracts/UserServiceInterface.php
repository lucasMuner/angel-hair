<?php

namespace App\Contracts;
use App\Models\User;

interface UserServiceInterface
{
    public function storeClientEmployee(array $data): User;
    public function updateClientEmployee(array $data, User $user): User;
}
