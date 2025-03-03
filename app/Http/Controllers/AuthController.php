<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function login():View
    {
        return view('auth.login');
    }

    public function connect(LoginRequest $request)
    {
        $credentials = $request->validated();

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->intended(route('property.index'));
        }

        return to_route('auth.login')->withErrors([
            'email' => 'Email ou mot de passe invalide'
        ])->onlyInput('email');
    }

    public function logout():RedirectResponse
    {
        Auth::logout();
        return to_route('auth.login')
            ->with('success', 'Vous avez bien été déconnecté');
    }
}
