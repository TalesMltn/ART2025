<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function gallery()
    {
        $projects = Project::where('status', 'completed')
            ->with(['client.user', 'artisan.user', 'rating'])  // AÑADE 'rating' AQUÍ
            ->latest('updated_at')
            ->paginate(12);
    
        return view('ratings.gallery', compact('projects'));
    }

    public function create(Project $project)
    {
        if (!auth()->user()?->isClient()) {
            return redirect('/gallery')->with('error', 'Solo clientes pueden valorar');
        }
    
        if ($project->status !== 'completed') {
            return redirect('/gallery')->with('error', 'El proyecto no está completado');
        }
    
        // QUITAMOS ESTO: || $project->rating
        // Ahora permite entrar aunque ya haya valoración (para editar)
    
        return view('ratings.create', compact('project'));
    }

    public function store(Request $request, $projectId)
{
    if (!auth()->user()?->isClient()) {
        return redirect('/gallery')->with('error', 'Solo clientes pueden valorar');
    }

    $project = Project::findOrFail($projectId);

    if ($project->status !== 'completed') {
        return back()->with('error', 'El proyecto no está completado');
    }

    $request->validate([
        'score'   => 'required|integer|min:1|max:5',
        'comment' => 'nullable|string|max:1000',
    ]);

    // ACTUALIZA si ya existe, o crea si no existe
    Rating::updateOrCreate(
        ['project_id' => $project->id],
        [
            'user_id'     => auth()->id(),
            'artisan_id'  => $project->artisan_id,
            'score'       => $request->score,
            'comment'     => $request->comment,
        ]
    );

    return redirect('/gallery')->with('success', '¡Valoración guardada con éxito!');
}
}