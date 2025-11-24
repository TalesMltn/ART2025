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
    
        // Cliente: si tiene perfil Client → lo usa, si no → usa su perfil Artisan como "cliente"
        $clientModel = $user->client ?? $user->artisan;
        $clientId    = $clientModel?->id;
    
        // Artesano: si tiene perfil Artisan → lo usa, si no → usa su perfil Client como "artesano"
        $artisanModel = $user->artisan ?? $user->client;
        $artisanId    = $artisanModel?->id;
    
        // NOMBRE SIEMPRE DEL USUARIO (Client y Artisan NO tienen name)
        $clientName  = $user->name;
        $artisanName = $user->name;
    
        // Nombre de tienda (solo si es artesano)
        $shopName = $user->artisan?->shop_name ?? '';
    
        return view('projects.publish', compact(
            'clientId', 'clientName',
            'artisanId', 'artisanName',
            'shopName'
        ));
    }
    /**
     * Guardar nuevo proyecto (solo clientes)
     */
    public function store(Request $request)
{
    $user = auth()->user()->fresh(['client', 'artisan']);

    $request->validate([
        'title'       => 'required|string|max:255',
        'description' => 'required|string',
        'price'       => 'nullable|numeric|min:0',
        'status'      => 'required|in:open,active,completed,cancelled', // ← EXACTO
    ]);

    $clientId  = $user->client?->id ?? $user->artisan?->id;
    $artisanId = $user->artisan?->id ?? $user->client?->id;

    Project::create([
        'client_id'   => $clientId,
        'artisan_id'  => $artisanId,
        'title'       => $request->title,
        'description' => $request->description,
        'price'       => $request->price,
        'status'      => $request->status, // ← ya validado arriba
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
    public function show(Project $project)
    {
        // Esto evita TODOS los errores de "user on null" en la vista
        $project->loadMissing(['client.user', 'artisan.user']);
    
        return view('projects.show', compact('project'));
    }
    public function rate(Request $request, Project $project)
{
    $request->validate([
        'rating'  => 'required|integer|min:1|max:5',
        'comment' => 'nullable|string|max:1000'
    ]);

    if ($project->status !== 'completed' || 
        auth()->user()->client?->id !== $project->client?->id ||
        $project->rating !== null) {
        return back()->with('error', 'No puedes valorar este proyecto.');
    }

    $project->update([
        'rating' => $request->rating,
        'rating_comment' => $request->comment
    ]);

    return back()->with('success', '¡Gracias por tu valoración!');
}
}