@extends('layouts.app')

@section('title', 'Mis Valoraciones')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Mis Valoraciones</h1>

        <!-- BOTÓN VOLVER AL INICIO -->
        <a href="{{ url('/') }}" 
           class="inline-flex items-center bg-indigo-600 text-white font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-indigo-700 transition">
            <i class="fas fa-arrow-left mr-2"></i> Volver al Inicio
        </a>
    </div>

    @if($ratings->count() > 0)
        <div class="grid gap-6">
            @foreach($ratings as $rating)
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900">{{ $rating->project->title }}</h3>
                            <p class="text-gray-600 mt-1">
                                Calificación: 
                                <span class="text-yellow-500">
                                    @for($i = 1; $i <= 5; $i++)
                                        {{ $i <= $rating->score ? '★' : '☆' }}
                                    @endfor
                                </span>
                            </p>
                            <p class="text-gray-700 mt-2">{{ $rating->comment }}</p>
                        </div>
                        <span class="text-sm text-gray-500">
                            {{ $rating->created_at->format('d/m/Y') }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-gray-50 p-8 rounded-lg text-center">
            <p class="text-gray-600">Aún no has realizado ninguna valoración.</p>
            <a href="{{ route('projects.index') }}" 
               class="mt-4 inline-block bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
                Explorar Proyectos
            </a>
        </div>
    @endif
</div>
@endsection
