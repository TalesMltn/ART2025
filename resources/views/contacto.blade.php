<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - Plataforma Artesanos Junín</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-teal-50 to-green-100 min-h-screen py-12 px-4">
    <div class="max-w-3xl mx-auto">
        <div class="text-center mb-12">
            <div class="mx-auto h-20 w-20 bg-teal-500 rounded-full flex items-center justify-center shadow-xl">
                <i class="fas fa-envelope text-3xl text-white"></i>
            </div>
            <h1 class="text-4xl font-bold text-teal-800 mt-6">Contáctanos</h1>
            <p class="text-lg text-teal-600 mt-3">¿Tienes dudas? ¡Estamos aquí para ayudarte!</p>
        </div>

        <div class="mb-8 text-left">
            <a href="{{ route('home') }}" 
               class="inline-flex items-center bg-gray-600 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:bg-gray-700 transition">
                <i class="fas fa-arrow-left mr-2"></i> Volver al Inicio
            </a>
        </div>

        <div class="bg-white rounded-3xl shadow-2xl p-8">
            <form method="POST" action="{{ route('contacto.submit') }}" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nombre</label>
                        <input type="text" name="name" required
                               class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-teal-500 @error('name') border-red-500 @enderror"
                               value="{{ old('name') }}">
                        @error('name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" required
                               class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-teal-500 @error('email') border-red-500 @enderror"
                               value="{{ old('email') }}">
                        @error('email') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Asunto</label>
                    <input type="text" name="subject" required
                           class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-teal-500 @error('subject') border-red-500 @enderror"
                           value="{{ old('subject') }}">
                    @error('subject') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Mensaje</label>
                    <textarea name="message" rows="6" required
                              class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-teal-500 @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                    @error('message') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="text-center">
                    <button type="submit"
                            class="px-8 py-4 bg-teal-600 text-white font-bold rounded-xl hover:bg-teal-700 transition">
                        Enviar Mensaje
                    </button>
                </div>

                @if(session('success'))
                    <div class="mt-6 p-4 bg-green-100 text-green-700 rounded-xl text-center">
                        {{ session('success') }}
                    </div>
                @endif
            </form>
        </div>
    </div>
</body>
</html>