

<?php $__env->startSection('title', 'Mis Valoraciones'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Mis Valoraciones</h1>

        <!-- BOTÓN VOLVER AL INICIO -->
        <a href="<?php echo e(url('/')); ?>" 
           class="inline-flex items-center bg-indigo-600 text-white font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-indigo-700 transition">
            <i class="fas fa-arrow-left mr-2"></i> Volver al Inicio
        </a>
    </div>

    <?php if($ratings->count() > 0): ?>
        <div class="grid gap-6">
            <?php $__currentLoopData = $ratings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rating): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900"><?php echo e($rating->project->title); ?></h3>
                            <p class="text-gray-600 mt-1">
                                Calificación: 
                                <span class="text-yellow-500">
                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                        <?php echo e($i <= $rating->score ? '★' : '☆'); ?>

                                    <?php endfor; ?>
                                </span>
                            </p>
                            <p class="text-gray-700 mt-2"><?php echo e($rating->comment); ?></p>
                        </div>
                        <span class="text-sm text-gray-500">
                            <?php echo e($rating->created_at->format('d/m/Y')); ?>

                        </span>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <div class="bg-gray-50 p-8 rounded-lg text-center">
            <p class="text-gray-600">Aún no has realizado ninguna valoración.</p>
            <a href="<?php echo e(route('projects.index')); ?>" 
               class="mt-4 inline-block bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
                Explorar Proyectos
            </a>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ArtesanosJunin2025\resources\views/ratings/index.blade.php ENDPATH**/ ?>