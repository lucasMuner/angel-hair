<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Log;

class MainController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function home()
    {
        return view('home.index');
    }

    public function appointments()
    {
        return view('appointments.index');
    }

    public function clients()
    {
        $clients = Client::join('users AS u', 'clients.user_id', '=', 'u.id')
            ->select('clients.*', 'u.name as name', 'u.email as email')
            ->get();

        return view('clients.index')->with('clients', $clients);
    }

    public function employees()
    {
        return view('employees.index');
    }

    public function services()
    {
        return view('services.index');
    }

    public function register()
    {
        return view('auth.register');
    }
}
