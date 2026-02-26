<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artesanos de Junín - Plataforma Artesanos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .card-hover:hover {
            transform: translateY(-6px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-amber-50 to-orange-100 min-h-screen py-12 px-4 sm:px-6 lg:px-8">

    <div class="max-w-7xl mx-auto">
        <!-- ENCABEZADO -->
        <div class="text-center mb-12">
            <div class="mx-auto h-24 w-24 bg-gradient-to-br from-amber-500 to-orange-600 rounded-3xl flex items-center justify-center mb-6 shadow-xl transform hover:scale-110 transition">
                <i class="fas fa-hands-helping text-4xl text-white"></i>
            </div>
            <h2 class="text-4xl font-bold text-[#5a2d0c]">Artesanos de Junín</h2>
            <p class="mt-3 text-lg text-amber-700">Conoce a los maestros de la tradición andina</p>
        </div>

        <!-- BOTÓN VOLVER -->
        <div class="mb-10 text-left">
            <a href="<?php echo e(route('home')); ?>" 
               class="inline-flex items-center bg-[#5a2d0c] text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:bg-[#7a3f10] transition transform hover:scale-105">
                <i class="fas fa-arrow-left mr-2"></i> Volver al Inicio
            </a>
        </div>

        <!-- LISTA DE ARTESANOS -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            <?php $__empty_1 = true; $__currentLoopData = $artisans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $artisan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <a href="<?php echo e(route('artisans.profile', $artisan)); ?>" 
                   class="block bg-white/95 backdrop-blur-sm p-6 rounded-2xl shadow-lg card-hover transition-all duration-300 border border-amber-100 group">
                    
                    <!-- Avatar con iniciales -->
                    <div class="flex items-center mb-5">
                        <div class="w-16 h-16 bg-gradient-to-br from-amber-400 to-orange-500 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-md ring-4 ring-white/50">
                            <?php echo e(strtoupper(substr($artisan->user->name, 0, 2))); ?>

                        </div>
                        <div class="ml-4 flex-1">
                            <h3 class="text-xl font-bold text-[#5a2d0c] group-hover:text-[#7a3f10] transition">
                                <?php echo e($artisan->user->name); ?>

                            </h3>
                            <?php if($artisan->shop_name): ?>
                                <p class="text-sm text-amber-600 italic truncate">"<?php echo e($artisan->shop_name); ?>"</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Bio -->
                    <p class="text-gray-700 text-sm line-clamp-3 mb-3">
                        <?php echo e($artisan->bio ?? 'Artesano dedicado a preservar la tradición andina.'); ?>

                    </p>

                    <!-- Dirección -->
                    <p class="text-xs text-gray-500 flex items-center mb-4">
                        <i class="fas fa-map-marker-alt mr-1.5 text-amber-600"></i>
                        <?php echo e($artisan->address ?? 'Junín, Perú'); ?>

                    </p>

                    <!-- Enlace -->
                    <div class="text-right">
                        <span class="text-[#5a2d0c] font-medium text-sm group-hover:underline flex items-center justify-end">
                            Ver perfil 
                            <i class="fas fa-arrow-right ml-1 transform group-hover:translate-x-1 transition"></i>
                        </span>
                    </div>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-span-full text-center py-20 bg-white/80 backdrop-blur rounded-3xl shadow-xl">
                    <i class="fas fa-palette text-7xl text-amber-300 mb-6"></i>
                    <p class="text-2xl font-semibold text-gray-700">Aún no hay artesanos registrados</p>
                    uncooked
                    <p class="text-sm text-amber-700 mt-3">¡Sé el primero en unirte a la comunidad!</p>
                    <a href="<?php echo e(route('register')); ?>" class="mt-6 inline-block bg-amber-600 text-white px-6 py-3 rounded-xl hover:bg-amber-700 transition shadow">
                        Regístrate como Artesano
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>

</body>
</html><?php /**PATH D:\ArtesanosJunin2025\resources\views/profiles/index.blade.php ENDPATH**/ ?>