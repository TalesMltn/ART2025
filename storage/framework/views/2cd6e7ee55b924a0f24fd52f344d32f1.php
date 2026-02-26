


<?php $__env->startSection('title', 'Editar Proyecto - Artesanos Junín'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6 max-w-4xl">
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">

        <!-- CABECERA SEGÚN ROL -->
        <?php if(auth()->user()->isClient() && is_null($project->artisan_id)): ?>
            <div class="bg-gradient-to-r from-indigo-600 to-purple-700 text-white p-8 text-center">
                <h1 class="text-3xl font-bold">Editar Proyecto</h1>
                <p class="text-lg mt-2 opacity-90">Puedes modificar todo mientras no esté asignado</p>
            </div>
        <?php else: ?>
            <div class="bg-gradient-to-r from-orange-600 to-red-700 text-white p-8 text-center">
                <h1 class="text-3xl font-bold">Actualizar Estado del Trabajo</h1>
                <p class="text-lg mt-2 opacity-90">Solo el artesano asignado puede cambiar el estado</p>
            </div>
        <?php endif; ?>

        <div class="p-8">

            <!-- ARTESANO ASIGNADO -->
            <?php if($project->artisan): ?>
                <div class="text-center mb-10 bg-green-50 p-6 rounded-xl border-2 border-green-300">
                    <div class="w-20 h-20 mx-auto bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center text-2xl font-bold text-white shadow-lg">
                        <?php echo e(strtoupper(substr($project->artisan->user->name, 0, 2))); ?>

                    </div>
                    <p class="mt-4 text-sm text-gray-600">Artesano asignado</p>
                    <p class="text-xl font-bold text-gray-800"><?php echo e($project->artisan->user->name); ?></p>
                    <p class="text-green-600 font-semibold">Trabajando en tu proyecto</p>
                </div>
            <?php else: ?>
                <div class="text-center mb-10 bg-gray-100 p-6 rounded-xl border-2 border-dashed border-gray-400">
                    <p class="text-lg text-gray-600 font-medium">Aún no hay artesano asignado</p>
                </div>
            <?php endif; ?>

            <!-- INFO DEL PROYECTO -->
            <div class="grid md:grid-cols-2 gap-6 mb-8 bg-gray-50 p-6 rounded-xl">
                <div>
                    <p class="text-sm text-gray-600 font-medium">Título del Proyecto</p>
                    <p class="text-xl font-bold text-gray-800 mt-1"><?php echo e($project->title); ?></p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 font-medium">Publicado por</p>
                    <p class="text-xl font-bold text-indigo-700 mt-1"><?php echo e($project->client->user->name); ?></p>
                </div>
            </div>

            <div class="bg-gray-50 p-6 rounded-xl mb-8 border">
                <p class="text-gray-700 leading-relaxed"><?php echo nl2br(e($project->description)); ?></p>
            </div>

            <form action="<?php echo e(route('projects.update', $project)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <!-- PRECIO ACORDADO -->
                <div class="mb-8">
                    <label class="block text-lg font-bold text-gray-800 mb-3">
                        Precio acordado (S/)
                    </label>

                    <?php if(auth()->user()->isClient() && is_null($project->artisan_id)): ?>
                        <input type="number" step="0.01" name="price" value="<?php echo e(old('price', $project->price)); ?>"
                               class="w-full px-5 py-4 rounded-lg border-2 border-gray-300 focus:border-indigo-500 text-lg"
                               placeholder="Ej: 855.00">
                        <p class="text-sm text-gray-600 mt-2">Puedes cambiarlo mientras no esté asignado</p>
                    <?php else: ?>
                        <div class="bg-emerald-50 p-6 rounded-lg border-2 border-emerald-500 text-center">
                            <p class="text-4xl font-bold text-emerald-700">
                                S/ <?php echo e(number_format($project->price ?? 0, 2)); ?>

                            </p>
                            <p class="text-lg font-semibold text-emerald-600 mt-3">PRECIO ACORDADO - NO SE PUEDE MODIFICAR</p>

                            <?php if($project->price != old('price') && old('price') !== null): ?>
                                <div class="mt-4 p-4 bg-red-100 border-2 border-red-500 rounded-lg">
                                    <p class="text-red-800 font-bold">INTENTO DE FRAUDE DETECTADO</p>
                                    <p class="text-sm text-red-700">Cliente intentó cambiar a S/ <?php echo e(old('price')); ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                        <input type="hidden" name="price" value="<?php echo e($project->price); ?>">
                    <?php endif; ?>
                </div>

                <!-- ESTADO DEL PROYECTO -->
                <div class="mb-10">
                    <label class="block text-lg font-bold text-gray-800 mb-3">
                        Estado del Proyecto
                    </label>

                    <?php if(auth()->user()->isArtisan() && $project->artisan_id == auth()->user()->artisan->id): ?>
                        <select name="status" required class="w-full px-5 py-4 rounded-lg border-2 border-orange-400 focus:border-orange-600 text-lg font-medium">
                            <option value="pending" <?php echo e(old('status', $project->status) == 'pending' ? 'selected' : ''); ?>>Pendiente</option>
                            <option value="active" <?php echo e(old('status', $project->status) == 'active' ? 'selected' : ''); ?>>En Progreso</option>
                            <option value="completed" <?php echo e(old('status', $project->status) == 'completed' ? 'selected' : ''); ?>>Completado</option>
                            <option value="cancelled" <?php echo e(old('status', $project->status) == 'cancelled' ? 'selected' : ''); ?>>Cancelado</option>
                        </select>
                        <p class="text-sm text-orange-600 font-medium mt-3 text-center">Solo tú puedes cambiar el estado</p>
                    <?php else: ?>
                        <div class="bg-purple-50 p-6 rounded-lg border-2 border-purple-500 text-center">
                            <p class="text-4xl font-bold text-purple-700">
                                <?php echo e(ucfirst(str_replace('_', ' ', $project->status))); ?>

                            </p>
                            <p class="text-purple-600 font-semibold mt-2">ESTADO CONTROLADO POR EL ARTESANO</p>

                            <?php if($project->status != old('status') && old('status') !== null): ?>
                                <div class="mt-4 p-4 bg-red-100 border-2 border-red-500 rounded-lg">
                                    <p class="text-red-800 font-bold">INTENTO DE FRAUDE GRAVE</p>
                                    <p class="text-sm text-red-700">Cliente intentó cambiar el estado</p>
                                </div>
                            <?php endif; ?>
                        </div>
                        <input type="hidden" name="status" value="<?php echo e($project->status); ?>">
                    <?php endif; ?>
                </div>

                <!-- BOTONES -->
                <div class="flex gap-4 justify-center">
                    <?php if((auth()->user()->isClient() && is_null($project->artisan_id)) || 
                       (auth()->user()->isArtisan() && $project->artisan_id == auth()->user()->artisan->id)): ?>
                        <button type="submit"
                                class="px-10 py-4 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold text-lg rounded-lg shadow-lg transition">
                            Guardar Cambios
                        </button>
                    <?php endif; ?>

                    <a href="<?php echo e(route('projects.show', $project)); ?>"
                    class="inline-flex items-center gap-3 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold px-8 py-4 rounded-xl shadow-xl transition transform hover:scale-105">
                    Volver al Proyecto
                    </a>
                </div>
 <!-- BOTÓN VOLVER AL INICIO -->
 <div class="mt-12 text-center">
    <a href="<?php echo e(url('/')); ?>" 
    class="inline-flex items-center gap-3 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold px-8 py-4 rounded-xl shadow-xl transition transform hover:scale-105">
    <i class="fas fa-arrow-left mr-2"></i> Volver al Inicio
    </a>
</div>
                <?php if(session('success')): ?>
                    <div class="mt-8 p-5 bg-green-100 border-2 border-green-500 rounded-lg text-center">
                        <p class="text-green-800 font-bold text-lg"><?php echo e(session('success')); ?></p>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ArtesanosJunin2025\resources\views/projects/edit.blade.php ENDPATH**/ ?>