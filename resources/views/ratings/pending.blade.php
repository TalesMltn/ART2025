{{-- resources/views/ratings/pending.blade.php --}}
@extends('layouts.app')

@section('title', 'Mis Valoraciones Pendientes')

@section('content')
<div class="container mx-auto p-8 max-w-6xl">

    <h1 class="text-5xl font-extrabold text-center text-indigo-800 mb-10">
        Valorar Trabajos Completados
    </h1>

    @if($projects->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($projects as $project)
                <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border-4 border-yellow-200 hover:border-yellow-500 transition transform hover:scale-105">
                    <div class="bg-gradient-to-r from-indigo-600 to-purple-700 text-white p-8 text-center">
                        <h3 class="text-2xl font-bold">{{ $project->title }}</h3>
                        <p class="mt-2 opacity-90">Completado el {{ $project->updated_at->format('d/m/Y') }}</p>
                    </div>

                    <div class="p-10 text-center">
                        <div class="w-28 h-28 mx-auto bg-green-100 rounded-full flex items-center justify-center text-5xl font-bold text-green-600 shadow-xl mb-6">
                            {{ strtoupper(substr($project->artisan->user->name, 0, 2)) }}
                        </div>
                        <p class="text-2xl font-bold text-gray-800">{{ $project->artisan->user->name }}</p>
                        <p class="text-green-600 font-semibold mb-8">Te entregó este trabajo</p>

                        @if($project->price)
                            <p class="text-3xl font-bold text-indigo-600 mb-8">
                                S/ {{ number_format($project->price, 0, ',', '.') }}
                            </p>
                        @endif

                        <a href="{{ route('ratings.create', $project) }}"
                           class="inline-block px-14 py-6 bg-gradient-to-r from-yellow-500 to-orange-600 hover:from-yellow-600 hover:to-orange-700 text-white font-bold text-2xl rounded-full shadow-2xl transform hover:scale-110 transition">
                            Valorar Ahora
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-24 bg-gradient-to-b from-gray-50 to-white rounded-3xl">
            <i class="fas fa-check-circle text-12xl text-green-500 mb-8"></i>
            <h3 class="text-5xl font-bold text-gray-800 mb-6">¡Todo al día!</h3>
            <p class="text-2xl text-gray-600">No tienes trabajos pendientes por valorar</p>
            <a href="{{ route('projects.index') }}" class="mt-10 inline-block px-12 py-6 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-2xl rounded-full">
                Ver Mis Proyectos
            </a>
        </div>
    @endif
</div>
@endsection