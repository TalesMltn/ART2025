<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Artisan;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // ==================================
    // MOSTRAR FORMULARIO DE REGISTRO
    // ==================================
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // ==================================
    // REGISTRAR USUARIO
    // ==================================
    public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8|confirmed',
        'role' => 'required|in:client,artisan',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
    ]);

    // Crea perfil básico (opcional, puedes dejarlo)
    if ($request->role === 'artisan') {
        $user->artisan()->create([
            'shop_name' => $request->name . ' Artesanías',
            'bio' => 'Artesano tradicional de Junín.',
            'address' => 'Junín, Perú',
        ]);
    } else {
        $user->client()->create([
            'address' => 'Junín, Perú',
            'phone' => null,
        ]);
    }

    Auth::login($user);

    // ¡AHORA SÍ VA DIRECTO AL HOME!
    return redirect()->route('home')
        ->with('success', '¡Registro exitoso! Bienvenido a la plataforma.');
}
    // ==================================
    // MOSTRAR FORMULARIO DE LOGIN
    // ==================================
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // ==================================
    // INICIAR SESIÓN
    // ==================================
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden.',
        ]);
    }

    // ==================================
    // CERRAR SESIÓN
    // ==================================
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}