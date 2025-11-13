<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicar Proyecto - Plataforma Artesanos Junín</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-purple-50 to-indigo-100 min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl w-full space-y-8 bg-white p-10 rounded-2xl shadow-2xl">
        <div class="text-center">
            <div class="mx-auto h-24 w-24 bg-indigo-500 rounded-2xl flex items-center justify-center mb-6">
                <i class="fas fa-plus-circle text-4xl text-white"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-900">Publicar Nuevo Proyecto</h2>
            <p class="mt-2 text-lg text-gray-600">Crea un proyecto para conectar con artesanos</p>
        </div>

        <form method="POST" action="{{ route('projects.store') }}" class="mt-8 space-y-6">
            @csrf

            <div class="space-y-4">

                <!-- CLIENTE FIJO -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-user mr-2 text-indigo-500"></i>Cliente
                    </label>
                    <div class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl text-gray-700">
                        {{ $clientName }} (Tú)
                        <input type="hidden" name="client_id" value="{{ $clientId }}">
                    </div>
                </div>

                <!-- ARTESANO FIJO -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-hammer mr-2 text-indigo-500"></i>Artesano
                    </label>
                    <div class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl text-gray-700">
                        {{ $artisanName }} (Tú)
                        <input type="hidden" name="artisan_id" value="{{ $artisanId }}">
                    </div>
                </div>

                <!-- TÍTULO -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-heading mr-2 text-indigo-500"></i>Título
                    </label>
                    <input 
                        id="title" 
                        name="title" 
                        type="text" 
                        required 
                        placeholder="Ejemplo: Mesa de Madera Personalizada"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 @error('title') border-red-500 @enderror"
                        value="{{ old('title') }}"
                    >
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- DESCRIPCIÓN -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-align-left mr-2 text-indigo-500"></i>Descripción
                    </label>
                    <textarea 
                        id="description" 
                        name="description" 
                        required 
                        rows="4"
                        placeholder="Detalla los requisitos del proyecto..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 @error('description') border-red-500 @enderror"
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- PRECIO (OPCIONAL) -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-dollar-sign mr-2 text-indigo-500"></i>Precio estimado (opcional)
                    </label>
                    <input 
                        type="number" 
                        step="0.01" 
                        name="price" 
                        id="price"
                        placeholder="450.00" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 @error('price') border-red-500 @enderror"
                        value="{{ old('price') }}"
                    >
                    @error('price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- BOTÓN ENVIAR -->
            <button 
                type="submit" 
                class="w-full flex justify-center py-4 px-4 border border-transparent text-lg font-medium rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition shadow-lg"
            >
                <i class="fas fa-paper-plane mr-2"></i>
                Publicar Proyecto
            </button>
        </form>

        <!-- VOLVER -->
        <div class="mt-6 text-center">
            <a href="{{ route('projects.index') }}" class="text-indigo-600 hover:text-indigo-500 font-medium flex items-center justify-center">
                <i class="fas fa-arrow-left mr-2"></i>Volver a la Lista
            </a>
        </div>
    </div>
</body>
</html>