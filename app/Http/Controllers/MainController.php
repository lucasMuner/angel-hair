<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('clients.index');
    }

    public function employees()
    {
        return view('employees.index');
    }

    public function services()
    {
        return view('services.index');
    }
}
