<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Mostrar formulario de login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Procesar login
     */
    public function login(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'contraseña' => 'required|min:6',
        ]);

        $user = User::where('correo', $request->correo)->first();

        if ($user && Hash::check($request->contraseña, $user->contraseña)) {
            // Verificar si el usuario está activo
            if ($user->estado === 'inactivo') {
                return back()->with('error', 'Tu cuenta ha sido desactivada. Contacta al administrador.');
            }
            Auth::login($user);
            return redirect()->route('dashboard')->with('success', 'Bienvenido');
        }

        return back()->with('error', 'Correo o contraseña incorrectos.');
    }

    /**
     * Mostrar formulario de registro
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Procesar registro
     */
    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:Usuarios',
            'contraseña' => 'required|min:6|confirmed',
            'rol' => 'required|in:Admin,Gerente,Desarrollador',
        ]);

        User::create([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'contraseña' => Hash::make($request->contraseña),
            'rol' => $request->rol,
        ]);

        return redirect()->route('login')->with('success', 'Registro exitoso. Por favor inicia sesión.');
    }

    /**
     * Logout
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Sesión cerrada exitosamente.');
    }

    /**
     * Dashboard
     */
    public function dashboard()
    {
        return view('dashboard');
    }
}
