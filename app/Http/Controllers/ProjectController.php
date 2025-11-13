<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Artisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Mostrar lista de proyectos (cliente + artesano)
     */
    public function index()
    {
        $user = Auth::user();
        $myProjects = collect();
        $otherArtisanProjects = collect();
    
        // === CLIENTE ===
        if ($user->isClient()) {
            $myProjects = Project::where('client_id', $user->id)
                ->with(['artisan.user']) // ← Ya está
                ->latest()
                ->get();
    
            $otherArtisanProjects = Project::whereNotNull('artisan_id')
                ->whereNotIn('status', ['completed', 'cancelled'])
                ->with(['client.user', 'artisan.user']) // ← AQUÍ ESTABA EL PROBLEMA
                ->latest()
                ->get();
        }
    
        // === ARTESANO ===
        if ($user->isArtisan() && $user->artisan) {
            $myProjects = Project::where('artisan_id', $user->artisan->id)
                ->with(['client.user']) // ← CARGA client.user
                ->latest()
                ->get();
    
            $otherArtisanProjects = Project::where('artisan_id', '!=', $user->artisan->id)
                ->whereNotNull('artisan_id')
                ->whereNotIn('status', ['completed', 'cancelled'])
                ->with(['client.user', 'artisan.user'])
                ->latest()
                ->take(6)
                ->get();
        }
    
        return view('projects.index', compact('myProjects', 'otherArtisanProjects'));
    }
    /**
     * Mostrar formulario para publicar proyecto (solo clientes)
     */
    public function create()
    {
        $user = Auth::user();
    
        // Cliente: si es cliente, usa su Client; si no, usa su Artisan como cliente
        $client = $user->isClient() ? $user->client : $user->artisan;
        $clientId = $client?->id;
        $clientName = $client?->name ?? $user->name;
    
        // Artesano: si es artesano, usa su Artisan; si no, usa su Client como artesano
        $artisan = $user->isArtisan() ? $user->artisan : $user->client;
        $artisanId = $artisan?->id;
        $artisanName = $artisan?->name ?? $user->name;
    
        $shopName = optional($artisan)->shop_name ?? '';
        return view('projects.publish', compact(
            'clientId', 'clientName',
            'artisanId', 'artisanName'
        ));
    }
    /**
     * Guardar nuevo proyecto (solo clientes)
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'nullable|numeric|min:0',
        ]);

        // Cliente y Artesano = el mismo usuario (según su rol)
        $client = $user->isClient() ? $user->client : $user->artisan;
        $artisan = $user->isArtisan() ? $user->artisan : $user->client;

        Project::create([
            'client_id' => $client?->id,
            'artisan_id' => $artisan?->id,
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('projects.index')
            ->with('success', '¡Proyecto publicado con éxito!');
    }
    /**
     * Mostrar formulario de edición (solo artesano dueño)
     */
    public function edit(Project $project)
    {
        $user = Auth::user();

        if (!$user->isArtisan() || !$user->artisan || $project->artisan_id !== $user->artisan->id) {
            abort(403, 'No tienes permiso para editar este proyecto.');
        }

        return view('projects.edit', compact('project'));
    }

    /**
     * Actualizar proyecto (solo artesano dueño)
     */
    public function update(Request $request, Project $project)
    {
        $user = Auth::user();

        if (!$user->isArtisan() || !$user->artisan || $project->artisan_id !== $user->artisan->id) {
            abort(403, 'No tienes permiso para editar este proyecto.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'nullable|numeric|min:0',
            'status' => 'required|in:pending,active,completed,cancelled',
        ]);

        $project->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price ?? null,
            'status' => $request->status,
        ]);

        return redirect()->route('projects.index')
            ->with('success', 'Proyecto actualizado correctamente.');
    }
}