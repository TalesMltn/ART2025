<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($project->title); ?> - Artesanos Junín</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-purple-50 to-indigo-100 min-h-screen py-12 px-4">

    <div class="max-w-5xl mx-auto">

        <!-- Botón Volver -->
        <div class="mb-8">
            <a href="<?php echo e(url()->previous()); ?>" class="inline-flex items-center bg-indigo-600 text-white font-semibold px-5 py-2.5 rounded-lg shadow-md hover:bg-indigo-700 transition">
                <i class="fas fa-arrow-left mr-2"></i> Volver atrás
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">

            <!-- Header del proyecto -->
            <div class="bg-gradient-to-r from-indigo-600 to-purple-700 p-8 text-white">
                <h1 class="text-3xl md:text-4xl font-bold"><?php echo e($project->title); ?></h1>
                <div class="flex flex-wrap items-center gap-4 mt-4 text-sm opacity-90">
                    <span><i class="fas fa-calendar mr-1"></i> Publicado el <?php echo e($project->created_at->format('d/m/Y')); ?></span>
                    <span class="px-3 py-1 bg-white/20 rounded-full text-xs font-bold">
                        <?php echo e(ucfirst(str_replace('_', ' ', $project->status))); ?>

                    </span>
                </div>
            </div>

            <div class="p-8">

                <!-- Información principal -->
                <div class="grid md:grid-cols-3 gap-8 mb-10">

                    <!-- CLIENTE (quien publicó) -->
                    <div class="text-center md:text-left">
                        <?php if($project->client?->user): ?>
                            <div class="w-24 h-24 mx-auto md:mx-0 bg-indigo-100 rounded-full flex items-center justify-center text-4xl font-bold text-indigo-600 mb-3">
                                <?php echo e(strtoupper(substr($project->client->user->name, 0, 2))); ?>

                            </div>
                            <p class="text-sm text-gray-600">Publicado por</p>
                            <p class="text-xl font-bold text-gray-800"><?php echo e($project->client->user->name); ?></p>
                            <p class="text-sm text-gray-500"><?php echo e($project->client->user->email); ?></p>
                        <?php else: ?>
                            <div class="text-center py-8">
                                <i class="fas fa-user-slash text-6xl text-gray-300"></i>
                                <p class="text-gray-500 mt-3 text-sm">No disponible</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- ARTESANO ASIGNADO -->
                    <div class="text-center md:text-left">
                        <?php if($project->artisan?->user): ?>
                            <div class="w-24 h-24 mx-auto md:mx-0 bg-green-100 rounded-full flex items-center justify-center text-4xl font-bold text-green-600 mb-3">
                                <?php echo e(strtoupper(substr($project->artisan->user->name, 0, 2))); ?>

                            </div>
                            <p class="text-sm text-gray-600">Artesano asignado</p>
                            <p class="text-xl font-bold text-gray-800"><?php echo e($project->artisan->user->name); ?></p>
                            <p class="text-sm text-green-600 font-medium">Trabajando en tu proyecto</p>
                        <?php else: ?>
                            <div class="text-center py-8">
                                <i class="fas fa-hammer text-6xl text-gray-300"></i>
                                <p class="text-gray-500 mt-3 text-sm">Sin artesano asignado aún</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- PRECIO -->
                    <div class="text-center md:text-right">
                        <p class="text-sm text-gray-600">Presupuesto</p>
                        <?php if($project->price): ?>
                            <p class="text-4xl font-bold text-indigo-600">S/ <?php echo e(number_format($project->price, 2)); ?></p>
                            <p class="text-sm text-gray-500">Precio acordado</p>
                        <?php else: ?>
                            <p class="text-3xl font-bold text-gray-400">Por definir</p>
                            <p class="text-sm text-gray-500">Pendiente de cotización</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Descripción completa -->
                <div class="border-t pt-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-align-left mr-3 text-indigo-600"></i> Descripción del Proyecto
                    </h2>
                    <div class="bg-gray-50 p-6 rounded-xl text-gray-700 whitespace-pre-line leading-relaxed">
                        <?php echo e($project->description ?? 'Sin descripción disponible.'); ?>

                    </div>
                </div>

                <!-- Botones de acción -->
                <div class="mt-10 flex flex-wrap gap-4 justify-center md:justify-end">
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(auth()->user()->isClient() && $project->client?->id == auth()->user()->client?->id && $project->status === 'pending'): ?>
                            <a href="<?php echo e(route('projects.edit', $project)); ?>" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-6 rounded-lg shadow transition">
                                <i class="fas fa-edit mr-2"></i> Editar Proyecto
                            </a>
                        <?php endif; ?>

                        <?php if(auth()->user()->isArtisan() && $project->artisan?->id == auth()->user()->artisan?->id): ?>
                            <a href="<?php echo e(route('projects.edit', $project)); ?>" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg shadow transition">
                                <i class="fas fa-tools mr-2"></i> Actualizar Progreso
                            </a>
                        <?php endif; ?>

                        <?php if($project->artisan?->user && auth()->user()->isClient()): ?>
                            <a href="https://wa.me/51<?php echo e($project->artisan->user->phone ?? ''); ?>" target="_blank"
                               class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg shadow transition">
                                <i class="fab fa-whatsapp mr-2"></i> Contactar Artesano
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

            </div>
        </div>

        <!-- Proyecto completado -->
        <?php if($project->status === 'completed'): ?>
            <div class="mt-8 text-center p-8 bg-green-50 border-2 border-green-300 rounded-2xl">
                <i class="fas fa-check-circle text-6xl text-green-600 mb-4"></i>
                <h3 class="text-2xl font-bold text-green-800">¡Proyecto Completado!</h3>
                <p class="text-green-700 mt-2">Gracias por confiar en Artesanos Junín</p>
            </div>
        <?php endif; ?>

        <!-- SISTEMA DE VALORACIÓN CON 5 ESTRELLAS -->
        <?php if(auth()->guard()->check()): ?>
            <?php if($project->status === 'completed' && auth()->user()->isClient() && $project->client?->id == auth()->user()->client?->id): ?>

                <!-- Ya valoró -->
                <?php if($project->rating): ?>
                    <div class="mt-10 bg-gradient-to-r from-green-50 to-emerald-50 border-2 border-green-300 rounded-2xl p-8 text-center">
                        <h3 class="text-2xl font-bold text-green-800 mb-4">
                            <i class="fas fa-check-circle mr-2"></i> ¡Gracias por tu valoración!
                        </h3>
                        <div class="flex justify-center gap-3 text-5xl">
                            <?php for($i = 1; $i <= 5; $i++): ?>
                                <i class="fas fa-star <?php echo e($i <= $project->rating ? 'text-yellow-500' : 'text-gray-300'); ?>"></i>
                            <?php endfor; ?>
                        </div>
                        <?php if($project->rating_comment): ?>
                            <p class="mt-5 text-lg text-gray-700 italic max-w-2xl mx-auto">"<?php echo e($project->rating_comment); ?>"</p>
                        <?php endif; ?>
                        <p class="text-sm text-gray-600 mt-6">Tu opinión ayuda a otros clientes a elegir al mejor artesano</p>
                    </div>

                <!-- Aún no valoró → Formulario -->
                <?php else: ?>
                    <div class="mt-10 bg-white border-2 border-indigo-200 rounded-2xl p-10 shadow-xl">
                        <h3 class="text-3xl font-bold text-indigo-800 text-center mb-8">
                            <i class="fas fa-star mr-3 text-yellow-500"></i> 
                            Valora la artesanía y el servicio
                        </h3>

                        <form action="<?php echo e(route('projects.rate', $project)); ?>" method="POST" class="max-w-2xl mx-auto space-y-8">
                            <?php echo csrf_field(); ?>

                            <!-- Estrellas interactivas -->
                            <div class="text-center">
                                <div class="flex justify-center gap-6 text-7xl cursor-pointer" id="rating-stars">
                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                        <label class="transform transition hover:scale-110">
                                            <input type="radio" name="rating" value="<?php echo e($i); ?>" class="hidden" required>
                                            <i class="fas fa-star text-gray-300 hover:text-yellow-400 transition duration-200"
                                               data-value="<?php echo e($i); ?>"></i>
                                        </label>
                                    <?php endfor; ?>
                                </div>
                                <p class="mt-6 text-xl font-medium text-gray-700" id="rating-text">Toca las estrellas para valorar</p>
                            </div>

                            <!-- Comentario -->
                            <div>
                                <label for="comment" class="block text-lg font-medium text-gray-700 mb-3">
                                    ¿Quieres dejar un comentario? (Opcional)
                                </label>
                                <textarea name="comment" id="comment" rows="4"
                                          class="w-full px-5 py-4 border-2 border-gray-300 rounded-xl focus:ring-4 focus:ring-indigo-300 focus:border-indigo-500 transition"
                                          placeholder="Ej: El trabajo fue impecable, muy puntual y excelente atención..."></textarea>
                            </div>

                            <!-- Enviar -->
                            <div class="text-center">
                                <button type="submit"
                                        class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold text-xl py-5 px-12 rounded-full shadow-2xl transition transform hover:scale-105">
                                    <i class="fas fa-paper-plane mr-3"></i> Enviar mi valoración
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- JavaScript para estrellas interactivas -->
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const stars = document.querySelectorAll('#rating-stars i');
                            const ratingText = document.getElementById('rating-text');

                            const messages = ['', 'Pésimo', 'Malo', 'Regular', 'Bueno', '¡Excelente!'];

                            stars.forEach((star, index) => {
                                const value = index + 1;

                                star.addEventListener('click', () => {
                                    document.querySelector(`input[value="${value}"]`).checked = true;

                                    stars.forEach((s, i) => {
                                        s.classList.toggle('text-yellow-500', i < value);
                                        s.classList.toggle('text-gray-300', i >= value);
                                    });

                                    ratingText.textContent = `${value} estrella${value > 1 ? 's' : ''} - ${messages[value]}`;
                                    ratingText.className = 'mt-6 text-xl font-bold ' + 
                                        (value <= 2 ? 'text-red-600' : value <= 3 ? 'text-orange-600' : 'text-green-600');
                                });

                                star.addEventListener('mouseover', () => {
                                    stars.forEach((s, i) => {
                                        if (i <= index) s.classList.replace('text-gray-300', 'text-yellow-400');
                                    });
                                });

                                star.parentElement.addEventListener('mouseout', () => {
                                    stars.forEach((s) => {
                                        if (!s.classList.contains('text-yellow-500')) {
                                            s.classList.replace('text-yellow-400', 'text-gray-300');
                                        }
                                    });
                                });
                            });
                        });
                    </script>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>

    </div>
</body>
</html><?php /**PATH D:\ArtesanosJunin2025\resources\views/projects/show.blade.php ENDPATH**/ ?>