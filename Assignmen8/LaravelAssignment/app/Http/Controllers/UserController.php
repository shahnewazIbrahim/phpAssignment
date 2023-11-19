<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function greetings()
    {
        return "Hello, Laravel!";
    }
    public function login(Request $request)
    {
        if ($request->email === Auth::user()->email && $request->password ===  Auth::user()->password) {

            return "Login successful";
        }
        return 'Invalid credentials';
    }
}
