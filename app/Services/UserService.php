<?php

namespace App\Services;

use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserService {

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
