<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicar Proyecto - Plataforma Artesanos Junín</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-purple-50 to-indigo-100 min-h-screen flex items-center justify-center py-12">
    <div class="max-w-2xl w-full bg-white p-10 rounded-2xl shadow-2xl">

        <div class="text-center mb-8">
            <div class="mx-auto h-24 w-24 bg-indigo-600 rounded-2xl flex items-center justify-center shadow-lg">
                <i class="fas fa-plus-circle text-5xl text-white"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-900">Publicar Nuevo Proyecto</h2>
            <p class="text-gray-600">Tú eres cliente y artesano del proyecto</p>
        </div>

        <!-- Mensajes -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-xl mb-6 text-center font-bold">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-xl mb-6">
                <strong>Errores:</strong>
                <ul class="list-disc list-inside mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('projects.store') }}" class="space-y-7">
            @csrf

            <!-- CLIENTE -->
            <div class="bg-blue-50 p-6 rounded-xl border border-blue-200 text-center">
                <p class="font-bold text-blue-800 mb-1">Cliente (tú)</p>
                <p class="text-2xl font-bold text-gray-800">{{ $clientName }}</p>
            </div>

            <!-- ARTESANO -->
            <div class="bg-green-50 p-6 rounded-xl border border-green-200 text-center">
                <p class="font-bold text-green-800 mb-1">Artesano (tú)</p>
                <p class="text-2xl font-bold text-gray-800">
                    {{ $artisanName }}
                    @if($shopName) <span class="text-green-700">({{ $shopName }})</span> @endif
                </p>
            </div>

            <!-- TÍTULO -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Título del Proyecto
                </label>
                <input name="title" type="text" required placeholder="Ej: Mesa de madera tallada"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 @error('title') border-red-500 @enderror"
                       value="{{ old('title') }}">
                @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- DESCRIPCIÓN -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Descripción Detallada
                </label>
                <textarea name="description" required rows="6" placeholder="Materiales, medidas, estilo, plazo..."
                          class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 resize-none @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- PRECIO -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Presupuesto Estimado (opcional)
                </label>
                <input name="price" type="number" step="0.01" placeholder="500.00"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl @error('price') border-red-500 @enderror"
                       value="{{ old('price') }}">
            </div>

            <!-- ESTADO - 100% COMPATIBLE CON TU MIGRACIÓN -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Estado Inicial del Proyecto
                </label>
                <select name="status" class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-indigo-500">
                    <option value="open" selected>Abierto</option>
                    <option value="active">En curso</option>
                    <option value="completed">Completado</option>
                    <option value="cancelled">Cancelado</option>
                </select>
            </div>

            <!-- BOTONES -->
            <div class="flex gap-4 pt-8">
                <button type="submit" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 rounded-xl transition shadow-lg transform hover:scale-105">
                    PUBLICAR PROYECTO
                </button>
                <a href="{{ route('projects.index') }}" class="px-8 py-4 bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium rounded-xl transition">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</body>
</html>