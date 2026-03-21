<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('username', 'password');

        $user = User::where('name', $credentials['username'])->first();

        if(!$user) return $this->redirectWithError('loginError', 'Usuário não encontrado!');

        $password = $credentials['password'];

        if(!password_verify($password, $user->password)){
            return $this->redirectWithError('loginError', 'Senha incorreta!');
        }

        session(['user_id' => $user->id]);

        return redirect()->route('home');
    }

    public function logout()
    {
        session()->forget('user_id');
        return redirect()->route('login');
    }

}


