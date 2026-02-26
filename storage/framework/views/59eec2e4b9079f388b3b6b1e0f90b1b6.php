
<?php $__env->startSection('title', 'Mis Proyectos y Ofertas - Artesanos Junín'); ?>
<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6 max-w-7xl">

    <!-- CABECERA -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 mb-12">
        <div>
            <h1 class="text-4xl font-extrabold text-gray-900">
                <?php if(auth()->user()->isClient() && !auth()->user()->isArtisan()): ?>
                    Mis Proyectos como Cliente
                <?php elseif(auth()->user()->isArtisan() && !auth()->user()->isClient()): ?>
                    Mis Trabajos y Servicios Ofrecidos
                <?php else: ?>
                    Mis Proyectos y Servicios
                <?php endif; ?>
            </h1>
            <p class="text-lg text-gray-600 mt-2">Gestiona tus proyectos y ofertas activas</p>
        </div>

        <div class="flex flex-wrap gap-4">
            <a href="<?php echo e(url('/')); ?>" class="inline-flex items-center gap-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-7 py-3.5 rounded-xl shadow-lg transition">
                Volver al Inicio
            </a>
            <?php if(auth()->user()->isClient() || auth()->user()->isArtisan()): ?>
                <a href="<?php echo e(route('projects.publish')); ?>" class="inline-flex items-center gap-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-7 py-3.5 rounded-xl shadow-lg transition">
                    Publicar Nuevo Proyecto
                </a>
            <?php endif; ?>
        </div>
    </div>

    <!-- MIS PROYECTOS ACTIVOS -->
    <?php if($myProjects->count() > 0): ?>
        <div class="mb-20">
            <h2 class="text-3xl font-bold text-indigo-700 mb-8">
                Mis proyectos activos
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php $__currentLoopData = $myProjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition transform hover:-translate-y-1 border border-gray-200 relative">

                        <!-- MENSAJE ANTIFRAUDE (visible para ambos) -->
                        <?php if($project->artisan_id && $project->status !== 'completed'): ?>
                            <div class="absolute inset-0 bg-black bg-opacity-10 pointer-events-none rounded-2xl"></div>
                            <div class="absolute top-4 right-4 bg-gradient-to-r from-red-600 to-orange-600 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg z-10">
                                TRABAJO EN CURSO - Solo el artesano puede cambiar el estado
                            </div>
                        <?php endif; ?>

                        <?php if($project->status === 'completed'): ?>
                            <div class="absolute top-4 right-4 bg-gradient-to-r from-green-600 to-emerald-700 text-white px-6 py-3 rounded-full text-lg font-bold shadow-2xl z-10 flex items-center gap-2">
                                COMPLETADO
                            </div>
                        <?php endif; ?>

                        <div class="bg-gradient-to-r 
                            <?php if($project->status === 'completed'): ?> from-green-500 to-emerald-600
                            <?php elseif($project->status === 'active'): ?> from-blue-500 to-cyan-600
                            <?php elseif($project->status === 'pending'): ?> from-purple-500 to-pink-600
                            <?php else: ?> from-gray-500 to-gray-600 <?php endif; ?> 
                            text-white p-6">
                            <h3 class="text-xl font-bold"><?php echo e($project->title); ?></h3>
                            <p class="text-sm opacity-90 mt-2">
                                <?php if(auth()->user()->isClient()): ?>
                                    Artesano: <?php echo e($project->artisan?->user?->name ?? 'Sin asignar'); ?>

                                <?php else: ?>
                                    Cliente: <?php echo e($project->client?->user?->name ?? 'Sin cliente'); ?>

                                <?php endif; ?>
                            </p>
                        </div>

                        <div class="p-6">
                            <p class="text-gray-700 mb-4 line-clamp-3"><?php echo e(Str::limit($project->description, 120)); ?></p>

                            <div class="flex items-center justify-between mb-5">
                                <span class="inline-block px-4 py-2 rounded-full text-sm font-bold
                                    <?php if($project->status === 'completed'): ?> bg-green-100 text-green-800
                                    <?php elseif($project->status === 'active'): ?> bg-blue-100 text-blue-800
                                    <?php elseif($project->status === 'pending'): ?> bg-purple-100 text-purple-800
                                    <?php else: ?> bg-yellow-100 text-yellow-800 <?php endif; ?>">
                                    <?php echo e(ucfirst(str_replace('_', ' ', $project->status))); ?>

                                </span>
                                <?php if($project->price): ?>
                                    <span class="text-lg font-bold text-gray-800">S/ <?php echo e(number_format($project->price, 0, ',', '.')); ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="flex gap-3">
                                <a href="<?php echo e(route('projects.show', $project)); ?>" 
                                   class="flex-1 text-center bg-indigo-600 text-white py-3.5 rounded-lg font-bold hover:bg-indigo-700 transition">
                                    Ver Detalles
                                </a>

                                <!-- BOTÓN EDITAR: solo cliente si está OPEN, solo artesano si ya fue tomado -->
                                <?php if(auth()->user()->isClient() && is_null($project->artisan_id) && $project->status === 'open'): ?>
                                    <a href="<?php echo e(route('projects.edit', $project)); ?>" 
                                       class="px-6 py-3.5 bg-amber-600 hover:bg-amber-700 text-white font-bold rounded-lg transition">
                                        Editar Proyecto
                                    </a>
                                <?php endif; ?>

                                <?php if(auth()->user()->isArtisan() && $project->artisan_id == auth()->user()->artisan->id && $project->status !== 'completed'): ?>
                                    <a href="<?php echo e(route('projects.edit', $project)); ?>" 
                                       class="px-6 py-3.5 bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-700 hover:to-red-700 text-white font-bold rounded-lg transition shadow-lg">
                                        Cambiar Estado
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- PROYECTOS DISPONIBLES PARA TOMAR (solo artesanos) -->
    <?php if(auth()->user()->isArtisan() && $publicOpenProjects->count() > 0): ?>
        <div class="mt-24 pt-12 border-t-8 border-dashed border-yellow-500 bg-gradient-to-b from-yellow-50 to-white rounded-3xl p-12">
            <h2 class="text-5xl font-extrabold text-yellow-700 mb-8 text-center">
                ¡HAY <?php echo e($publicOpenProjects->count()); ?> TRABAJO<?php echo e($publicOpenProjects->count() > 1 ? 'S' : ''); ?> DISPONIBLE<?php echo e($publicOpenProjects->count() > 1 ? 'S' : ''); ?>!
            </h2>
            <p class="text-center text-2xl text-gray-700 mb-12">Estos clientes necesitan un artesano ahora mismo</p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                <?php $__currentLoopData = $publicOpenProjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border-8 border-yellow-500 hover:border-orange-600 transition-all transform hover:scale-105">
                        <div class="bg-gradient-to-r from-yellow-500 to-orange-600 text-white p-10 text-center">
                            <h3 class="text-3xl font-extrabold mb-4"><?php echo e($project->title); ?></h3>
                            <p class="text-xl">Cliente: <strong><?php echo e($project->client?->user?->name); ?></strong></p>
                            <?php if($project->price): ?>
                                <p class="text-5xl font-extrabold mt-6">S/ <?php echo e(number_format($project->price, 0, ',', '.')); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="p-10 bg-yellow-50 text-center">
                            <p class="text-gray-800 mb-8"><?php echo e($project->description); ?></p>
                            <form action="<?php echo e(route('projects.take', $project)); ?>" method="POST" class="inline">
                                <?php echo csrf_field(); ?>
                                <button type="submit"
                                        class="inline-block bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-700 hover:to-red-700 text-white font-bold text-2xl px-16 py-6 rounded-3xl shadow-2xl transform hover:scale-110 transition">
                                    TOMAR ESTE PROYECTO AHORA
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- SIN PROYECTOS -->
    <?php if($myProjects->count() === 0 && (!auth()->user()->isArtisan() || $publicOpenProjects->count() === 0)): ?>
        <div class="text-center py-32 bg-gradient-to-b from-gray-50 to-white rounded-3xl">
            <h3 class="text-5xl font-bold text-gray-800 mb-6">
                Todavía no tienes proyectos activos
            </h3>
            <p class="text-2xl text-gray-600 mb-12">
                <?php if(auth()->user()->isArtisan()): ?>
                    Cuando un cliente publique un proyecto, aparecerá aquí para que lo tomes
                <?php else: ?>
                    ¡Publica tu primer proyecto y encuentra al mejor artesano!
                <?php endif; ?>
            </p>
            <?php if(auth()->user()->isClient() || auth()->user()->isArtisan()): ?>
                <a href="<?php echo e(route('projects.publish')); ?>" class="inline-block bg-indigo-600 text-white px-16 py-8 rounded-3xl font-bold text-3xl hover:bg-indigo-700 transition shadow-2xl transform hover:scale-110">
                    Publicar mi primer proyecto
                </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ArtesanosJunin2025\resources\views/projects/index.blade.php ENDPATH**/ ?>