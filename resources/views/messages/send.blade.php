<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar Mensaje a {{ $artisan->user->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-teal-50 to-green-100 min-h-screen py-12 px-4">
    <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-xl p-8">
        <div class="flex items-center mb-6">
            <a href="{{ route('artisans.profile', $artisan) }}" class="text-teal-600 hover:text-teal-800">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
            <h1 class="text-2xl font-bold text-gray-900 ml-4">Contactar a {{ $artisan->user->name }}</h1>
        </div>

        <form method="POST" action="{{ route('messages.send', $artisan->user_id) }}" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Mensaje</label>
                <textarea name="content" rows="6" required
                          class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-teal-500 @error('content') border-red-500 @enderror"
                          placeholder="Escribe tu consulta...">{{ old('content') }}</textarea>
                @error('content') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex space-x-4">
                <a href="{{ route('artisans.profile', $artisan) }}" 
                   class="flex-1 py-3 px-6 bg-gray-500 text-white rounded-xl text-center hover:bg-gray-600 transition">
                    Cancelar
                </a>
                <button type="submit" 
                        class="flex-1 py-3 px-6 bg-teal-600 text-white rounded-xl hover:bg-teal-700 transition">
                    Enviar Mensaje
                </button>
            </div>
        </form>

        @if(session('success'))
            <div class="mt-4 p-4 bg-green-100 text-green-700 rounded-xl text-center">
                {{ session('success') }}
            </div>
        @endif
    </div>
</body>
</html>