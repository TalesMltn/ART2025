<?php

namespace App\Http\Controllers;

use App\Models\Artisan;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Lista pública de todos los artesanos
     */
    public function index()
    {
        $artisans = Artisan::with('user')->get();
        return view('profiles.index', compact('artisans'));
    }

    /**
     * Mostrar perfil del usuario logueado
     */
    public function show()
    {
        $user = Auth::user();
        $profile = $user->role === 'artisan' ? $user->artisan : $user->client;

        if (!$profile || !$this->hasCompleteProfile($user)) {
            return redirect()->route('profile.create')
                ->with('warning', 'Por favor, completa tu perfil para continuar.');
        }

        return view('profiles.show', compact('profile', 'user'));
    }

    /**
     * Formulario para crear perfil
     */
    public function create()
    {
        $user = Auth::user();

        if ($this->hasCompleteProfile($user)) {
            return redirect()->route('profile.show')
                ->with('info', 'Tu perfil ya está completo.');
        }

        return view('profiles.create', compact('user'));
    }

    /**
     * Guardar perfil nuevo
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        $rules = ['address' => 'required|string|max:255'];
        if ($user->role === 'artisan') {
            $rules += [
                'shop_name'     => 'required|string|max:255',
                'bio'           => 'required|string|max:1000',
                'bank_details'  => 'nullable|string|max:500',
            ];
        } else {
            $rules += ['phone' => 'required|string|regex:/^[0-9]{9}$/'];
        }

        $request->validate($rules);

        if ($user->role === 'artisan') {
            $user->artisan()->updateOrCreate(
                ['user_id' => $user->id],
                $request->only(['shop_name', 'bio', 'address', 'bank_details'])
            );
        } else {
            $user->client()->updateOrCreate(
                ['user_id' => $user->id],
                $request->only(['address', 'phone'])
            );
        }

        return redirect()->route('profile.show')
            ->with('success', '¡Perfil creado con éxito!');
    }

    /**
     * Formulario para editar perfil
     */
    public function edit()
    {
        $user = Auth::user();
        $profile = $user->role === 'artisan' ? $user->artisan : $user->client;

        if (!$profile) {
            return redirect()->route('profile.create');
        }

        return view('profiles.edit', compact('profile', 'user'));
    }

    /**
     * Actualizar perfil existente
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $profile = $user->role === 'artisan' ? $user->artisan : $user->client;

        if (!$profile) {
            return redirect()->route('profile.create');
        }

        $rules = ['address' => 'required|string|max:255'];
        if ($user->role === 'artisan') {
            $rules += [
                'shop_name'     => 'required|string|max:255',
                'bio'           => 'required|string|max:1000',
                'bank_details'  => 'nullable|string|max:500',
            ];
        } else {
            $rules += ['phone' => 'required|string|regex:/^[0-9]{9}$/'];
        }

        $request->validate($rules);

        $profile->update(
            $user->role === 'artisan'
                ? $request->only(['shop_name', 'bio', 'address', 'bank_details'])
                : $request->only(['address', 'phone'])
        );

        return redirect()->route('profile.show')
            ->with('success', '¡Perfil actualizado con éxito!');
    }

    /**
     * Perfil público de un artesano
     */
    public function publicShow(Artisan $artisan)
    {
        $artisan->load('user', 'projects'); // Carga relación con proyectos
        return view('profiles.public-show', compact('artisan'));
    }

    // =========================================
    // MÉTODO AUXILIAR: ¿Tiene perfil completo?
    // =========================================
    private function hasCompleteProfile($user)
    {
        if ($user->role === 'artisan') {
            $artisan = $user->artisan;
            return $artisan && 
                   !empty($artisan->shop_name) && 
                   $artisan->shop_name !== $user->name . ' Artesanías' &&
                   !empty($artisan->bio) &&
                   !empty($artisan->address);
        }

        $client = $user->client;
        return $client && 
               !empty($client->phone) && 
               !empty($client->address);
    }
}