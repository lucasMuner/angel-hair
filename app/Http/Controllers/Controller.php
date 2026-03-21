<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function __construct()
    {

    }

    public function redirectWithError($key, $message)
    {
        return redirect()->back()->withInput()->with($key, $message);
    }
}
