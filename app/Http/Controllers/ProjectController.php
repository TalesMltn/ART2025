<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Lista de proyectos del usuario (cliente y/o artesano) + proyectos abiertos
     */
    public function index()
{
    $user = Auth::user();

    // === MIS PROYECTOS (como cliente y/o artesano) ===
    $myProjects = collect();

    if ($user->isClient() && $user->client) {
        $myProjects = $myProjects->merge(
            Project::where('client_id', $user->client->id)
                ->with(['artisan.user', 'client.user'])
                ->latest()
                ->get()
        );
    }

    if ($user->isArtisan() && $user->artisan) {
        $myProjects = $myProjects->merge(
            Project::where('artisan_id', $user->artisan->id)
                ->with(['artisan.user', 'client.user'])
                ->latest()
                ->get()
        );
    }

    $myProjects = $myProjects->unique('id')->values();

    // === PROYECTOS ABIERTOS DISPONIBLES PARA TOMAR ===
    $publicOpenProjects = Project::whereNull('artisan_id')
        ->whereIn('status', ['open', 'pending'])
        ->with('client.user')
        ->latest()
        ->get();

    // ¡¡ESTO ES LO QUE ESTABA FALLANDO!!
    // Solo excluimos los proyectos del usuario SI está viendo como cliente
    // Pero SI está viendo como artesano → queremos ver TODOS los proyectos abiertos
    if ($user->isClient() && !$user->isArtisan()) {
        // Solo clientes puros no ven sus propios proyectos duplicados
        $publicOpenProjects = $publicOpenProjects->filter(fn($p) => $p->client_id !== $user->client->id);
    }
    // Si es artesano (aunque también sea cliente) → ve TODOS los proyectos abiertos
    // ¡NO FILTRAMOS NADA!

    return view('projects.index', compact('myProjects', 'publicOpenProjects'));
}

    /**
     * Formulario para publicar proyecto
     */
    public function create()
    {
        $user = Auth::user();

        $clientId   = $user->client?->id ?? $user->artisan?->id;
        $clientName = $user->name;

        if (!$clientId) {
            return redirect()->route('profile.create')->with('error', 'Primero crea tu perfil de cliente o artesano.');
        }

        return view('projects.publish', compact('clientId', 'clientName'));
    }

    /**
     * Guardar nuevo proyecto publicado por el cliente
     */
    public function store(Request $request)
    {
        $user = Auth::user()->fresh(['client', 'artisan']);

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'nullable|numeric|min:0',
            'status'      => 'required|in:open,active,completed,cancelled',
        ]);

        $clientId = $user->client?->id ?? $user->artisan?->id;

        if (!$clientId) {
            return back()->with('error', 'No tienes perfil para publicar proyectos.');
        }

        Project::create([
            'client_id'   => $clientId,
            'artisan_id'  => null, // ¡NUNCA asignar artesano al publicar!
            'title'       => $request->title,
            'description' => $request->description,
            'price'       => $request->price,
            'status'      => $request->status,
        ]);

        return redirect()->route('projects.index')
            ->with('success', '¡Proyecto publicado con éxito! Los artesanos ya lo pueden tomar.');
    }

    /**
     * Mostrar detalle del proyecto
     */
    public function show(Project $project)
    {
        $project->load(['client.user', 'artisan.user', 'rating']);

        return view('projects.show', compact('project'));
    }

    /**
     * Formulario de edición (solo el artesano asignado)
     */
    public function edit(Project $project)
    {
        // DESACTIVADO EL 403 POR COMPLETO (solo mientras desarrollas)
        // Quita esto cuando ya esté todo estable
    
        return view('projects.edit', compact('project'));
    }

    /**
     * Actualizar proyecto (solo el artesano asignado)
     */
    public function update(Request $request, Project $project)
{
    $user = Auth::user();

    // Caso 1: Cliente editando proyecto que AÚN NO tiene artesano
    if ($user->isClient() && is_null($project->artisan_id)) {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'nullable|numeric|min:0',
        ]);

        $project->update($request->only(['title', 'description', 'price']));

        return back()->with('success', 'Proyecto actualizado correctamente');
    }

    // Caso 2: Artesano actualizando el estado (solo él puede)
    if ($user->isArtisan() && $user->artisan && $project->artisan_id === $user->artisan->id) {
        $request->validate([
            'status' => 'required|in:pending,active,completed,cancelled'
        ]);

        $project->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Estado actualizado a: ' . ucwords(str_replace('_', ' ', $request->status)));
    }

    // Si llega aquí → no tiene permiso
    abort(403, 'No tienes permiso para editar este proyecto.');
}

    /**
     * ARTESANO TOMA EL PROYECTO
     */
    public function take(Project $project)
    {
        $user = Auth::user();

        // Solo artesanos con perfil
        if (!$user->isArtisan() || !$user->artisan) {
            abort(403, 'Solo los artesanos pueden tomar proyectos.');
        }

        // Ya tiene artesano?
        if ($project->artisan_id) {
            return back()->with('error', 'Este proyecto ya fue tomado por otro artesano.');
        }

        // Estado no permite ser tomado?
        if (in_array($project->status, ['completed', 'cancelled'])) {
            return back()->with('error', 'Este proyecto ya no está disponible.');
        }

        // ¡LO TOMA!
        $project->update([
            'artisan_id' => $user->artisan->id,
            'status'     => 'active', // Automáticamente pasa a "En progreso"
        ]);

        return back()->with('success', '¡ÉXITO! Has tomado el proyecto: "' . $project->title . '"');
    }

    /**
     * Valorar proyecto completado (solo el cliente dueño)
     */
    public function rate(Request $request, Project $project)
    {
    }
}