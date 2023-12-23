<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create()
    {
        // Show form to register a new user
        return view('users.create');
    }

    public function store(Request $request)
    {
        // Store the new user
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        return redirect()->route('users.create')->with('success', 'User registered successfully');
    }
}
