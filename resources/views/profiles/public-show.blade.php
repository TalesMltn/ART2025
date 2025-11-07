<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $artisan->user->name }} - Artesano en Junín</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .card-hover:hover { transform: translateY(-4px); box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1); }
    </style>
</head>
<body class="bg-gradient-to-br from-amber-50 to-orange-100 min-h-screen py-12 px-4">

    <div class="max-w-5xl mx-auto">
        <!-- BOTÓN VOLVER -->
        <div class="mb-8">
            <a href="{{ route('artisans.index') }}" 
               class="inline-flex items-center bg-[#5a2d0c] text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:bg-[#7a3f10] transition transform hover:scale-105">
                <i class="fas fa-arrow-left mr-2"></i> Volver a Artesanos
            </a>
        </div>

        <div class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-2xl overflow-hidden">
            <!-- HEADER -->
            <div class="bg-gradient-to-r from-amber-500 to-orange-600 p-8 text-white">
                <div class="flex items-center space-x-6">
                    <div class="w-32 h-32 bg-white/20 backdrop-blur rounded-full flex items-center justify-center text-5xl font-bold shadow-lg">
                        {{ strtoupper(substr($artisan->user->name, 0, 2)) }}
                    </div>
                    <div>
                        <h1 class="text-4xl font-bold">{{ $artisan->user->name }}</h1>
                        @if($artisan->shop_name)
                            <p class="text-2xl italic opacity-90">"{{ $artisan->shop_name }}"</p>
                        @endif
                        <p class="mt-2 flex items-center">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            {{ $artisan->address ?? 'Junín, Perú' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- CONTENIDO -->
            <div class="p-8 space-y-8">
                <div>
                    <h2 class="text-2xl font-bold text-[#5a2d0c] mb-3 flex items-center">
                        <i class="fas fa-info-circle mr-3 text-amber-600"></i> Sobre el Artesano
                    </h2>
                    <p class="text-gray-700 leading-relaxed text-lg">
                        {{ $artisan->bio ?? 'Artesano dedicado a preservar las tradiciones andinas con pasión y excelencia.' }}
                    </p>
                </div>

                @if($artisan->bank_details)
                <div class="bg-amber-50 p-6 rounded-2xl border border-amber-200">
                    <h3 class="text-lg font-semibold text-amber-800 mb-2 flex items-center">
                        <i class="fas fa-university mr-2"></i> Información de Pago
                    </h3>
                    <p class="text-gray-700 whitespace-pre-line">{{ $artisan->bank_details }}</p>
                </div>
                @endif

                @if($artisan->projects->count() > 0)
                <div>
                    <h2 class="text-2xl font-bold text-[#5a2d0c] mb-4 flex items-center">
                        <i class="fas fa-palette mr-3 text-amber-600"></i> Proyectos Destacados
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($artisan->projects->take(4) as $project)
                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 card-hover">
                            <h4 class="font-semibold text-gray-800">{{ $project->title }}</h4>
                            <p class="text-sm text-gray-600 mt-1">{{ Str::limit($project->description, 80) }}</p>
                            @if($project->price)
                                <p class="text-amber-600 font-bold mt-2">S/ {{ number_format($project->price, 2) }}</p>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                @auth
                <div class="text-center pt-6 border-t border-gray-200">
                    <a href="{{ route('messages.send.form', $artisan->user_id) }}" 
                       class="inline-flex items-center bg-gradient-to-r from-teal-600 to-green-600 text-white font-bold px-8 py-4 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition text-lg">
                        <i class="fas fa-envelope mr-3"></i> Contactar al Artesano
                    </a>
                </div>
                @else
                <div class="text-center pt-6 border-t border-gray-200">
                    <p class="text-gray-600 mb-4">¿Quieres contactar a este artesano?</p>
                    <a href="{{ route('login') }}" class="inline-flex items-center bg-teal-600 text-white font-bold px-8 py-4 rounded-xl shadow-lg hover:bg-teal-700 transition">
                        <i class="fas fa-sign-in-alt mr-2"></i> Iniciar Sesión
                    </a>
                </div>
                @endauth
            </div>
        </div>
    </div>
</body>
</html>