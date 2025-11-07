<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Valoración - Plataforma Artesanos Junín</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-yellow-50 to-orange-100 min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-xl w-full space-y-8 bg-white p-10 rounded-2xl shadow-2xl">
        <div class="text-center">
            <div class="mx-auto h-24 w-24 bg-orange-500 rounded-2xl flex items-center justify-center mb-6">
                <i class="fas fa-star text-4xl text-white"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-900">Registrar Valoración</h2>
            <p class="mt-2 text-lg text-gray-600">Evalúa el trabajo del artesano</p>
        </div>

        <form method="POST" action="{{ route('ratings.store', $project->id) }}" class="mt-8 space-y-6">
            @csrf
            <input type="hidden" name="project_id" value="{{ $project->id }}">
            <input type="hidden" name="artisan_id" value="{{ $project->artisan_id }}">

            <div>
                <label for="rating" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-star mr-2 text-orange-500"></i>Calificación (1-5)
                </label>
                <select 
                    id="rating" 
                    name="rating" 
                    required 
                    class="appearance-none relative block w-full px-4 py-3 border border-gray-300 text-gray-900 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 @error('rating') border-red-500 @enderror"
                >
                    <option value="">Selecciona una calificación</option>
                    <option value="1">1 - Muy Malo</option>
                    <option value="2">2 - Malo</option>
                    <option value="3">3 - Regular</option>
                    <option value="4">4 - Bueno</option>
                    <option value="5">5 - Excelente</option>
                </select>
                @error('rating')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-comment mr-2 text-orange-500"></i>Comentario
                </label>
                <textarea 
                    id="comment" 
                    name="comment" 
                    class="appearance-none relative block w-full px-4 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 @error('comment') border-red-500 @enderror"
                    placeholder="Escribe tu opinión..."
                ></textarea>
                @error('comment')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <button 
                type="submit" 
                class="group relative w-full flex justify-center py-4 px-4 border border-transparent text-lg font-medium rounded-xl text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition duration-200 shadow-lg"
            >
                <span class="absolute left-0 inset-y-0 flex items-center pl-4">
                    <i class="fas fa-save text-orange-200 group-hover:text-orange-100"></i>
                </span>
                Guardar Valoración
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('projects.index') }}" class="text-orange-600 hover:text-orange-500 font-medium flex items-center justify-center">
                <i class="fas fa-arrow-left mr-2"></i>Volver a Proyectos
            </a>
        </div>
    </div>
</body>
</html>