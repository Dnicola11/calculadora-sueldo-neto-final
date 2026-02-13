<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function index(): View
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'El usuario es requerido.',
            'password.required' => 'La contraseña es requerida.',
        ], [
            'username' => 'Usuario',
            'password' => 'Contraseña',
        ]);

        if (Auth::attempt($request->only('username', 'password'))) {
            return redirect()->route('home');
        }

        return back()
            ->withInput()
            ->with('message', 'El usuario o la contraseña son incorrectos.');
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();

        return redirect()->route('login');
    }
}
