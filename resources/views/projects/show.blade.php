{{-- resources/views/projects/show.blade.php --}}
@extends('layouts.app')

@section('title', $project->title . ' - Artesanos Junín')

@section('content')
<div class="container mx-auto p-6 max-w-7xl">

    <!-- Botones superiores -->
    <div class="flex flex-wrap justify-between items-center mb-10 gap-6">
        <a href="{{ route('projects.index') }}" 
           class="inline-flex items-center gap-3 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold px-8 py-4 rounded-xl shadow-xl transition transform hover:scale-105">
            Mis Proyectos
        </a>

        <a href="{{ route('ratings.gallery') }}" target="_blank"
        class="inline-flex items-center gap-3 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold px-8 py-4 rounded-xl shadow-xl transition transform hover:scale-105">
         Galería de Trabajos Completados
     </a>
    </div>

    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-200">

        <!-- Header -->
        <div class="bg-gradient-to-r from-indigo-600 to-purple-700 p-10 text-white">
            <h1 class="text-4xl md:text-5xl font-extrabold">{{ $project->title }}</h1>
            <div class="flex flex-wrap items-center gap-6 mt-6 text-lg opacity-90">
                <span>Publicado el {{ $project->created_at->format('d/m/Y') }}</span>
                <span class="px-5 py-2 bg-white/30 rounded-full font-bold">
                    {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                </span>
            </div>
        </div>

        <div class="p-10">

            <!-- Info en 3 columnas -->
            <div class="grid md:grid-cols-3 gap-10 mb-12">

                <!-- Cliente -->
                <div class="text-center">
                    <div class="w-28 h-28 mx-auto bg-indigo-100 rounded-full flex items-center justify-center text-4xl font-bold text-indigo-600 shadow-lg">
                        {{ $project->client?->user ? strtoupper(substr($project->client->user->name, 0, 2)) : '??' }}
                    </div>
                    <p class="mt-4 text-sm text-gray-600">Publicado por</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $project->client?->user?->name ?? 'Anónimo' }}</p>
                </div>

                <!-- Artesano -->
                <div class="text-center">
                    @if($project->artisan?->user)
                        <div class="w-28 h-28 mx-auto bg-green-100 rounded-full flex items-center justify-center text-4xl font-bold text-green-600 shadow-lg">
                            {{ strtoupper(substr($project->artisan->user->name, 0, 2)) }}
                        </div>
                        <p class="mt-4 text-sm text-gray-600">Artesano asignado</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $project->artisan->user->name }}</p>
                        <p class="text-green-600 font-bold">Trabajando en tu proyecto</p>
                    @else
                        <p class="text-gray-500 italic text-xl">Aún no asignado</p>
                    @endif
                </div>

                <!-- Precio -->
                <div class="text-center md:text-right">
                    <p class="text-sm text-gray-600">Precio acordado</p>
                    @if($project->price)
                        <p class="text-5xl font-extrabold text-indigo-600 mt-3">S/ {{ number_format($project->price, 0, ',', '.') }}</p>
                    @else
                        <p class="text-4xl font-bold text-gray-400 mt-3">Por definir</p>
                    @endif
                </div>
            </div>

            <!-- Descripción -->
            <div class="border-t-4 border-dashed border-indigo-200 pt-10">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Descripción del Proyecto</h2>
                <div class="bg-gray-50 p-8 rounded-2xl text-lg text-gray-700 leading-relaxed whitespace-pre-line">
                    {{ $project->description ?? 'Sin descripción.' }}
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="mt-12 flex flex-wrap gap-6 justify-center">
                @if(auth()->user()->isClient() && $project->client_id == auth()->user()->client?->id && is_null($project->artisan_id))
                    <a href="{{ route('projects.edit', $project) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-4 px-10 rounded-xl shadow-lg transition text-xl">
                        Editar Proyecto
                    </a>
                @endif

                @if(auth()->user()->isArtisan() && $project->artisan_id == auth()->user()->artisan?->id)
                    <a href="{{ route('projects.edit', $project) }}" class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-4 px-10 rounded-xl shadow-lg transition text-xl">
                        Actualizar Estado del Trabajo
                    </a>
                @endif

                @if($project->artisan?->user)
                    <a href="https://wa.me/51{{ $project->artisan->user->phone ?? '' }}" target="_blank"
                       class="bg-green-500 hover:bg-green-600 text-white font-bold py-4 px-10 rounded-xl shadow-lg transition text-xl flex items-center gap-3">
                        <i class="fab fa-whatsapp text-2xl"></i> Contactar por WhatsApp
                    </a>
                @endif
            </div>

            <!-- Solo mensaje si está completado -->
            @if($project->status === 'completed')
                <div class="mt-16 text-center p-12 bg-gradient-to-r from-green-50 to-emerald-50 border-4 border-green-400 rounded-3xl">
                    <h3 class="text-5xl font-bold text-green-800">¡Proyecto Completado con Éxito!</h3>
                    <p class="text-2xl text-green-700 mt-6">Gracias por confiar en los artesanos de Junín</p>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection