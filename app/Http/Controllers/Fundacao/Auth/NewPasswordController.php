<?php

namespace App\Http\Controllers\Fundacao\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules;

class NewPasswordController extends Controller
{
    public function create(Request $request)
    {
        return view('fundacao.auth.reset-password', ['request' => $request]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $status = Password::broker('users')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill(['password' => Hash::make($password)])->save();
            }
        );
        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('fundacao.login')->with('status', __($status))
                    : back()->withErrors(['email' => __($status)]);
    }
}
