<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function index()
    {
        // Muestra todas las valoraciones del usuario autenticado
        $ratings = Auth::user()->ratings()->with('project')->latest()->get();
        
        return view('ratings.index', compact('ratings'));
    }

    public function create($project)
    {
        // Mostrar formulario para valorar un proyecto específico
        $project = \App\Models\Project::findOrFail($project);
        return view('ratings.create', compact('project'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'artisan_id' => 'required|exists:artisans,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string'
        ]);

        // Asegura que el usuario no valore dos veces el mismo proyecto
        $existing = Rating::where('user_id', Auth::id())
                          ->where('project_id', $request->project_id)
                          ->first();

        if ($existing) {
            return back()->with('error', 'Ya has valorado este proyecto.');
        }

        $rating = Rating::create([
            'user_id' => Auth::id(),
            'project_id' => $request->project_id,
            'artisan_id' => $request->artisan_id,
            'score' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('projects.show', $rating->project_id)
                         ->with('success', '¡Valoración enviada con éxito!');
    }
}