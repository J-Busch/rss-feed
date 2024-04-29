<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function store()
    {
        $validatedAttributes = request()->validate([
            'login_email' => ['required', 'email'],
            'login_password' => ['required']
        ]);



        if (!Auth::attempt([
            'email' => $validatedAttributes['login_email'],
            'password' => $validatedAttributes['login_password']
        ])) {
            throw ValidationException::withMessages(([
                'login_email' => 'Sorry, those credentials do not match.'
            ]));
        }

        request()->session()->regenerate();

        return redirect('/feed');
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/');
    }
}
