


<?php $__env->startSection('title', 'Valorar a ' . $project->artisan->user->name); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6 max-w-4xl">

    <div class="bg-white rounded-3xl shadow-2xl p-12">

        <div class="text-center mb-12">
            <h1 class="text-5xl font-extrabold text-indigo-800 mb-6">
                ¡Valora el trabajo recibido!
            </h1>
            <div class="w-32 h-32 mx-auto bg-green-100 rounded-full flex items-center justify-center text-5xl font-bold text-green-600 shadow-2xl">
                <?php echo e(strtoupper(substr($project->artisan->user->name, 0, 2))); ?>

            </div>
            <p class="text-3xl font-bold text-gray-800 mt-6"><?php echo e($project->artisan->user->name); ?></p>
            <p class="text-xl text-gray-600">Te entregó:</p>
            <p class="text-2xl font-bold text-indigo-700 mt-3"><?php echo e($project->title); ?></p>
        </div>

        <form action="<?php echo e(route('ratings.store', $project)); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div class="text-center">
                <p class="text-2xl text-gray-700 mb-10">¿Cómo calificarías este trabajo?</p>

                <div class="flex justify-center gap-8 mb-8">
                    <?php for($i = 1; $i <= 5; $i++): ?>
                        <label class="cursor-pointer transform hover:scale-125 transition">
                            <input type="radio" name="score" value="<?php echo e($i); ?>" required class="hidden" <?php echo e(old('score') == $i ? 'checked' : ''); ?>>
                            <span class="text-9xl text-gray-300 hover:text-yellow-500 transition">
                                ★
                            </span>
                        </label>
                    <?php endfor; ?>
                </div>

                <p class="text-4xl font-bold text-yellow-600" id="selected-stars">
                    Toca las estrellas para valorar
                </p>
            </div>

            <div>
                <label class="block text-xl font-bold text-gray-800 mb-4">
                    Cuéntanos tu experiencia (opcional)
                </label>
                <textarea name="comment" rows="6" placeholder="Ej: Excelente trabajo, muy detallado y puntual..."
                          class="w-full p-6 rounded-2xl border-2 border-gray-300 focus:border-indigo-600 text-lg resize-none"><?php echo e(old('comment')); ?></textarea>
            </div>

            <div class="flex gap-6 justify-center">
                <button type="submit"
                        class="px-16 py-6 bg-gradient-to-r from-green-600 to-emerald-700 hover:from-green-700 hover:to-emerald-800 text-white font-bold text-3xl rounded-full shadow-2xl transform hover:scale-110 transition">
                    Enviar Valoración
                </button>

                <a href="<?php echo e(url('/gallery')); ?>" class="inline-flex items-center gap-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-7 py-3.5 rounded-xl shadow-lg transition">
                    Volver a la Galería
                </a>
            </div>
        </form>

        <script>
            document.querySelectorAll('input[name="score"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    const value = this.value;
                    document.querySelectorAll('label span').forEach((star, i) => {
                        star.classList.toggle('text-yellow-500', i < value);
                        star.classList.toggle('text-gray-300', i >= value);
                    });
                    document.getElementById('selected-stars').textContent = 
                        value == 1 ? '1 estrella' : value + ' estrellas';
                });
            });
        </script>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ArtesanosJunin2025\resources\views/ratings/create.blade.php ENDPATH**/ ?>