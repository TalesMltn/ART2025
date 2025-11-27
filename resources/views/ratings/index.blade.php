{{-- resources/views/ratings/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Valorar Trabajos Completados - Artesanos Junín')

@section('content')
<div class="container mx-auto p-6 max-w-7xl">

    <div class="text-center mb-12">
        <h1 class="text-5xl font-extrabold text-indigo-800 mb-4">
            Valorar Trabajos Completados
        </h1>
        <p class="text-xl text-gray-700">
            Tus proyectos terminados están esperando tu opinión
        </p>
    </div>

    @auth
        @php
            $pendingRatings = auth()->user()->client->projects()
                ->where('status', 'completed')
                ->whereNull('rating')
                ->with('artisan.user')
                ->latest()
                ->get();
        @endphp

        @if($pendingRatings->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($pendingRatings as $project)
                    <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border-4 border-indigo-200 hover:border-indigo-500 transition">
                        <div class="bg-gradient-to-r from-indigo-600 to-purple-700 text-white p-8 text-center">
                            <h3 class="text-2xl font-bold">{{ $project->title }}</h3>
                            <p class="mt-3 text-lg">Completado el {{ $project->updated_at->format('d/m/Y') }}</p>
                        </div>

                        <div class="p-8 text-center">
                            <div class="w-24 h-24 mx-auto bg-green-100 rounded-full flex items-center justify-center text-4xl font-bold text-green-600 shadow-lg mb-6">
                                {{ strtoupper(substr($project->artisan->user->name, 0, 2)) }}
                            </div>
                            <p class="text-xl font-bold text-gray-800">{{ $project->artisan->user->name }}</p>
                            <p class="text-green-600 font-semibold mb-6">Te entregó este trabajo</p>

                            @if($project->price)
                                <p class="text-3xl font-bold text-indigo-600 mb-8">
                                    S/ {{ number_format($project->price, 0, ',', '.') }}
                                </p>
                            @endif

                            <a href="{{ route('ratings.create', $project) }}"
                               class="inline-block px-12 py-5 bg-gradient-to-r from-yellow-500 to-orange-600 hover:from-yellow-600 hover:to-orange-700 text-white font-bold text-xl rounded-full shadow-xl transform hover:scale-110 transition">
                                Valorar Ahora
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20 bg-gradient-to-b from-gray-50 to-white rounded-3xl">
                <div class="w-32 h-32 mx-auto bg-gray-200 rounded-full flex items-center justify-center mb-8">
                    <i class="fas fa-check-circle text-6xl text-gray-400"></i>
                </div>
                <h3 class="text-4xl font-bold text-gray-800 mb-6">
                    ¡Todo al día!
                </h3>
                <p class="text-xl text-gray-600">
                    No tienes trabajos pendientes por valorar
                </p>
                <a href="{{ route('projects.index') }}" class="mt-10 inline-block px-12 py-5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xl rounded-full">
                    Volver a Mis Proyectos
                </a>
            </div>
        @endif
    @else
        <div class="text-center py-20">
            <p class="text-2xl text-gray-600">Inicia sesión para valorar tus trabajos</p>
        </div>
    @endauth

</div>
@endsection