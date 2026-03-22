<?php

namespace App\Services;

use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserService {

    public function storeClientEmployee (array $data): User
    {
        $user = new User();
        $user->username = str_replace(' ', '', strtolower($data['name']));
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['name'] . '@' . date('Y'));
        $user->saveWithLog();
        return $user;

    }

    public function updateClientEmployee (array $data, Client $client): User
    {
        $user = $client->user;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->username = str_replace(' ', '', strtolower($data['name']));
        $user->saveWithLog();
        return $user;
    }
}
