<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Client;
use App\Models\Role;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        $remember = $credentials['remember'] ?? false;

        unset($credentials['remember']);

        Log::info('Tentativa de login => ' . json_encode($credentials));
        if(Auth::attempt($credentials, $remember)) {
            // Regenerate session to prevent fixation attacks
            $request->session()->regenerate();

            /** @var \App\Models\User $user */
            $user = Auth::user();

            if (!$user->hasVerifiedEmail()) {
                $this->resendVerificationThrottled($user);

                return redirect()->route('verification.notice');
            }

            return redirect()->intended(route('home'));
        }

        Log::warning('Falha no login => ' . json_encode($credentials));
        return back()->withErrors([
            'username' => 'Usuário ou senha incorretos.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // Clear session data and regenerate token to prevent CSRF attacks
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function register(RegisterRequest $request)
    {

        DB::beginTransaction();
        $credentials = $request->validated();
        Log::info("Tentativa de registro => " . json_encode($credentials));
        try {

            $role = Role::where('name', 'client')->first();

            if(!$role) throw new \Exception('Não foi possível realizar o registro. Por favor, contate o administrador do sistema.');

            $user = User::create([
                'name' => $credentials['name'] ?? null,
                'username' => $credentials['username'],
                'password' => bcrypt($credentials['password']),
                'email' => $credentials['email'] ?? null,
                'role_id' => $role->id
            ]);

            $client = Client::create([
                'user_id' => $user->id,
                'phone' => $credentials['phone'] ?? null,
                'birth_date' => $credentials['birth_date'] ?? null
            ]);

            $user->sendEmailVerificationNotification();

            Auth::login($user);

            DB::commit();
            return redirect()->route('home');
        } catch (\Exception $e) {
            Log::error('Erro ao registrar usuário => ' . $e->getMessage());
            DB::rollBack();
            return back()->withErrors([
                'username' => 'Ocorreu um erro ao registrar. Por favor, tente novamente.',
            ])->onlyInput('username');
        }
    }

    private function resendVerificationThrottled(User $user): void
    {
        $key = "verification-resent:{$user->id}";

        if (! Cache::has($key)) {
            $user->sendEmailVerificationNotification();
            $this->markVerificationSent($user);
        }
    }

    private function markVerificationSent(User $user): void
    {
        Cache::put("verification-resent:{$user->id}", true, now()->addMinutes(5));
    }

}


