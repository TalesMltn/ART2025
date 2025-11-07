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
        $artisans = Artisan::all();
        return view('projects.publish', compact('artisans'));
    }

    /**
     * Guardar nuevo proyecto (solo clientes)
     */
    public function store(Request $request)
    {
        $request->validate([
            'artisan_id' => 'required|exists:artisans,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'nullable|numeric|min:0',
        ]);

        Project::create([
            'client_id' => Auth::id(),
            'artisan_id' => $request->artisan_id,
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price ?? null,
            'status' => 'pending', // ← SIEMPRE INICIA COMO PENDING
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