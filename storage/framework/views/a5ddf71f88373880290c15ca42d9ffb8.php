

<?php $__env->startSection('title', 'Galería de Trabajos Completados'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6 max-w-7xl">
    <div class="text-center mb-12">
        <h1 class="text-5xl font-extrabold text-indigo-800 mb-6">
            Galería de Trabajos Completados
        </h1>
        <a href="<?php echo e(url('/home')); ?>" 
           class="inline-block px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-full shadow-lg transition">
            ← Volver al Inicio
        </a>
    </div>

    <?php if($projects->count() > 0): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border-4 border-indigo-100 hover:border-indigo-500 transition transform hover:scale-105">
                    
                    <!-- Título y artesano -->
                    <div class="bg-gradient-to-r from-indigo-600 to-purple-700 text-white p-8 text-center">
                        <h3 class="text-2xl font-bold"><?php echo e($project->title); ?></h3>
                        <p class="mt-2 opacity-90">por <?php echo e($project->artisan->user->name); ?></p>
                    </div>

                    <div class="p-8 text-center space-y-6">
                        <!-- Avatar -->
                        <div class="w-24 h-24 mx-auto bg-green-100 rounded-full flex items-center justify-center text-4xl font-bold text-green-600 shadow-xl">
                            <?php echo e(strtoupper(substr($project->artisan->user->name, 0, 2))); ?>

                        </div>

                        <!-- ESTRELLAS + COMENTARIO -->
                        <?php if($project->rating): ?>
                            <div class="flex justify-center gap-2">
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                    <span class="text-5xl <?php echo e($i <= $project->rating->score ? 'text-yellow-500' : 'text-gray-300'); ?>">★</span>
                                <?php endfor; ?>
                            </div>
                            <?php if($project->rating->comment): ?>
                                <p class="text-gray-600 italic px-4">"<?php echo e(Str::limit($project->rating->comment, 100)); ?>"</p>
                            <?php endif; ?>

                            <!-- BOTÓN EDITAR VALORACIÓN (solo si eres cliente y ya valoraste) -->
                            <?php if(auth()->guard()->check()): ?>
                                <?php if(auth()->user()->isClient()): ?>
                                    <a href="<?php echo e(route('ratings.create', $project)); ?>"
                                       class="inline-block px-12 py-4 bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 text-white font-bold text-lg rounded-full shadow-xl transition transform hover:scale-110">
                                         Editar mi valoración
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php else: ?>
                            <p class="text-gray-500 text-lg">Aún no valorado</p>

                            <!-- BOTÓN VALORAR (solo si eres cliente y no valoraste) -->
                            <?php if(auth()->guard()->check()): ?>
                                <?php if(auth()->user()->isClient()): ?>
                                    <a href="<?php echo e(route('ratings.create', $project)); ?>"
                                       class="inline-block px-12 py-5 bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white font-bold text-xl rounded-full shadow-xl transform hover:scale-110 transition">
                                        ★ Valorar este trabajo ★
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <!-- Paginación -->
        <div class="mt-12">
            <?php echo e($projects->links()); ?>

        </div>
    <?php else: ?>
        <div class="text-center py-24 text-3xl text-gray-500">
            Aún no hay trabajos completados. ¡Pronto estarán aquí!
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ArtesanosJunin2025\resources\views/ratings/gallery.blade.php ENDPATH**/ ?>