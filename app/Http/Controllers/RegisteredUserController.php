<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use \App\Models\User;
use \Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    public function store()
    {
        $validatedAttributes = request()->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', Password::min(6), 'confirmed'],
            'password_confirmation' => ['required']
        ]);

        $user = User::create($validatedAttributes);

        Auth::login($user);

        return redirect('/feed/list');
    }
}
