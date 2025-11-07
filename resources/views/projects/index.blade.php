<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Proyectos - Plataforma Artesanos Junín</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-purple-50 to-indigo-100 min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- ENCABEZADO -->
        <div class="text-center mb-10">
            <div class="mx-auto h-20 w-20 bg-indigo-500 rounded-2xl flex items-center justify-center mb-6">
                <i class="fas fa-list text-3xl text-white"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-900">Lista de Proyectos</h2>
            <p class="mt-2 text-lg text-gray-600">Explora y gestiona los proyectos disponibles</p>

            <!-- BOTÓN PUBLICAR -->
            @if(auth()->check())
                <a href="{{ route('projects.publish') }}" 
                   class="mt-4 inline-block bg-indigo-600 text-white px-6 py-3 rounded-xl hover:bg-indigo-700 transition duration-200 shadow-lg font-semibold">
                    <i class="fas fa-plus mr-2"></i> Publicar Proyecto
                </a>
            @endif
        </div>

        <!-- BOTÓN VOLVER -->
        <div class="mb-8 text-left">
            <a href="{{ url('/') }}" 
               class="inline-flex items-center bg-indigo-600 text-white font-semibold px-5 py-2.5 rounded-lg shadow-md hover:bg-indigo-700 transition">
                <i class="fas fa-arrow-left mr-2"></i> Volver al Inicio
            </a>
        </div>

        <!-- MIS PROYECTOS -->
        @if($myProjects->count() > 0)
            <h3 class="text-2xl font-bold text-gray-800 mb-4">
                @if(auth()->user()->isClient())
                    Mis Proyectos Publicados
                @else
                    Mis Proyectos Asignados
                @endif
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                @foreach($myProjects as $project)
                    <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition duration-300 border-l-4 
                        @if(auth()->user()->isArtisan() && $project->artisan_id == auth()->user()->artisan->id) border-green-500 
                        @else border-blue-500 @endif">
                        <h4 class="text-xl font-semibold text-gray-900">{{ $project->title }}</h4>
                        <p class="mt-2 text-gray-600">{{ Str::limit($project->description, 100) }}</p>

                        <!-- USUARIO (CORREGIDO) -->
                        <p class="mt-2 text-sm text-gray-500">
                            <i class="fas fa-user mr-1"></i>
                            @if(auth()->user()->isClient() && $project->artisan?->user)
                                Artesano: <strong>{{ $project->artisan->user->name }}</strong>
                            @elseif(auth()->user()->isArtisan() && $project->client?->user)
                                Cliente: <strong>{{ $project->client->user->name }}</strong>
                            @else
                                <em>Usuario no disponible</em>
                            @endif
                        </p>

                        <!-- PRECIO -->
                        @if($project->price)
                            <p class="mt-1 text-sm text-indigo-600 font-medium">
                                <i class="fas fa-dollar-sign mr-1"></i> S/ {{ number_format($project->price, 2) }}
                            </p>
                        @else
                            <p class="mt-1 text-sm text-gray-400 italic">Precio por definir</p>
                        @endif

                        <!-- ESTADO -->
                        <p class="mt-1 text-sm font-medium 
                            @if($project->status == 'pending') text-yellow-600
                            @elseif($project->status == 'active') text-blue-600
                            @elseif($project->status == 'completed') text-green-600
                            @else text-red-600 @endif">
                            <i class="fas fa-circle mr-1 text-xs"></i> 
                            {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                        </p>

                        <div class="mt-4 flex gap-3">
                            <a href="#" class="text-indigo-600 hover:text-indigo-500 text-sm font-medium">
                                Ver Detalle <i class="fas fa-eye ml-1"></i>
                            </a>

                            @if(auth()->user()->isArtisan() && $project->artisan_id == auth()->user()->artisan->id)
                                <a href="{{ route('projects.edit', $project) }}" 
                                   class="text-green-600 hover:text-green-500 text-sm font-medium">
                                    Editar <i class="fas fa-edit ml-1"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- OTROS PROYECTOS DE ARTESANOS -->
        @if($otherArtisanProjects->count() > 0)
            <h3 class="text-2xl font-bold text-gray-800 mb-4">
                @if(auth()->user()->isClient())
                    Proyectos Disponibles de Artesanos
                @else
                    Proyectos de Otros Artesanos
                @endif
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($otherArtisanProjects as $project)
                    <div class="bg-gray-50 p-6 rounded-xl shadow-md border-l-4 border-gray-400 opacity-90 hover:opacity-100 transition">
                        <h4 class="text-lg font-semibold text-gray-800">{{ $project->title }}</h4>
                        <p class="mt-2 text-gray-600 text-sm">{{ Str::limit($project->description, 80) }}</p>

                        <!-- USUARIOS (CORREGIDO) -->
                        <p class="mt-2 text-xs text-gray-500">
                            <i class="fas fa-user mr-1"></i> 
                            Cliente: 
                            <strong>
                                {{ $project->client?->user?->name ?? 'No asignado' }}
                            </strong>
                        </p>
                        <p class="mt-1 text-xs text-gray-500">
                            <i class="fas fa-hammer mr-1"></i> 
                            Artesano: 
                            <strong>
                                {{ $project->artisan?->user?->name ?? 'No asignado' }}
                            </strong>
                        </p>

                        @if($project->price)
                            <p class="mt-1 text-xs text-indigo-600 font-medium">
                                <i class="fas fa-dollar-sign mr-1"></i> S/ {{ number_format($project->price, 2) }}
                            </p>
                        @endif
                        <p class="mt-1 text-xs font-medium text-gray-600">
                            <i class="fas fa-circle mr-1 text-xs"></i> 
                            {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                        </p>
                        <a href="#" class="mt-3 inline-block text-indigo-600 hover:text-indigo-500 text-xs font-medium">
                            Ver Detalle <i class="fas fa-eye ml-1"></i>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-600 text-lg">No hay proyectos de otros artesanos disponibles.</p>
                <p class="text-gray-500 text-sm mt-2">¡Sé el primero en publicar uno!</p>
            </div>
        @endif
    </div>
</body>
</html>