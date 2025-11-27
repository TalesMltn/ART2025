{{-- resources/views/projects/publish.blade.php --}}
@extends('layouts.app')

@section('title', 'Publicar Nuevo Proyecto - Artesanos Junín')

@section('content')
<div class="container mx-auto p-6 max-w-4xl">
    <div class="bg-white rounded-3xl shadow-2xl p-10">

        <div class="text-center mb-10">
            <h1 class="text-4xl font-extrabold text-gray-900">Publicar Nuevo Proyecto</h1>
            <p class="text-xl text-gray-600 mt-3">Busca al mejor artesano para tu idea</p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-xl mb-8 text-center font-bold text-lg">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('projects.store') }}" method="POST" class="space-y-8">
            @csrf

            <!-- Cliente (solo informativo) -->
            <div class="bg-gradient-to-r from-indigo-50 to-purple-50 p-8 rounded-2xl border-2 border-indigo-200 text-center">
                <p class="text-indigo-800 font-bold text-lg">Tú eres el cliente</p>
                <p class="text-3xl font-extrabold text-gray-800 mt-2">{{ auth()->user()->name }}</p>
            </div>

            <!-- Título -->
            <div>
                <label class="block text-lg font-bold text-gray-800 mb-3">Título del Proyecto</label>
                <input type="text" name="title" required value="{{ old('title') }}"
                       class="w-full px-6 py-4 rounded-xl border-2 @error('title') border-red-500 @else border-gray-300 @enderror focus:border-indigo-600 focus:ring-4 focus:ring-indigo-100 text-lg"
                       placeholder="Ej: Mesa de madera con tallado personalizado">
                @error('title') <p class="text-red-600 text-sm mt-2">{{ $message }}</p> @enderror
            </div>

            <!-- Descripción -->
            <div>
                <label class="block text-lg font-bold text-gray-800 mb-3">Descripción Detallada</label>
                <textarea name="description" required rows="8"
                          class="w-full px-6 py-4 rounded-xl border-2 @error('description') border-red-500 @else border-gray-300 @enderror focus:border-indigo-600 focus:ring-4 focus:ring-indigo-100 text-lg resize-none"
                          placeholder="Materiales, medidas, estilo, colores, plazo de entrega...">{{ old('description') }}</textarea>
                @error('description') <p class="text-red-600 text-sm mt-2">{{ $message }}</p> @enderror
            </div>

            <!-- Precio (opcional) -->
            <div>
                <label class="block text-lg font-bold text-gray-800 mb-3">Presupuesto Estimado (S/)</label>
                <input type="number" step="0.01" name="price" value="{{ old('price') }}"
                       class="w-full px-6 py-4 rounded-xl border-2 border-gray-300 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-100 text-lg"
                       placeholder="Ej: 850.00 (opcional)">
                @error('price') <p class="text-red-600 text-sm mt-2">{{ $message }}</p> @enderror
            </div>

            <!-- Estado inicial -->
            <div>
                <label class="block text-lg font-bold text-gray-800 mb-3">Estado del Proyecto</label>
                <select name="status" class="w-full px-6 py-4 rounded-xl border-2 border-gray-300 focus:border-indigo-600 text-lg">
                    <option value="open" selected>Abierto (buscando artesano)</option>
                    <option value="pending">Pendiente</option>
                    <option value="active">En progreso</option>
                    <option value="completed">Completado</option>
                </select>
            </div>

            <!-- Botones -->
            <div class="flex gap-6 pt-8">
                <button type="submit"
                        class="flex-1 bg-gradient-to-r from-indigo-600 to-purple-700 hover:from-indigo-700 hover:to-purple-800 text-white font-bold text-2xl py-6 rounded-2xl shadow-xl transform hover:scale-105 transition">
                    PUBLICAR PROYECTO
                </button>
                <a href="{{ route('projects.index') }}"
                   class="px-10 py-6 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold rounded-2xl transition">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection