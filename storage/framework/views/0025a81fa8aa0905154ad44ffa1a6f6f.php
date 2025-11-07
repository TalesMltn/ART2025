<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicar Proyecto - Plataforma Artesanos Junín</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-purple-50 to-indigo-100 min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl w-full space-y-8 bg-white p-10 rounded-2xl shadow-2xl">
        <div class="text-center">
            <div class="mx-auto h-24 w-24 bg-indigo-500 rounded-2xl flex items-center justify-center mb-6">
                <i class="fas fa-plus-circle text-4xl text-white"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-900">Publicar Nuevo Proyecto</h2>
            <p class="mt-2 text-lg text-gray-600">Crea un proyecto para conectar con artesanos</p>
        </div>

        <form method="POST" action="<?php echo e(route('projects.store')); ?>" class="mt-8 space-y-6">
            <?php echo csrf_field(); ?>

            <div class="space-y-4">
                <!-- ARTESANO -->
                <div>
                    <label for="artisan_id" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-hammer mr-2 text-indigo-500"></i>Artesano
                    </label>

                    <?php if(auth()->user()->isArtisan() && auth()->user()->artisan): ?>
                        <!-- ARTESANO: SOLO VE SU NOMBRE (NO SELECT) -->
                        <div class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl text-gray-700">
                            <?php echo e(auth()->user()->name); ?> - <?php echo e(auth()->user()->artisan->shop_name); ?>

                            <input type="hidden" name="artisan_id" value="<?php echo e(auth()->user()->artisan->id); ?>">
                        </div>
                    <?php else: ?>
                        <!-- CLIENTE: ELIGE CUALQUIER ARTESANO -->
                        <select 
                            id="artisan_id" 
                            name="artisan_id" 
                            required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 <?php $__errorArgs = ['artisan_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        >
                            <option value="">Selecciona un artesano</option>
                            <?php $__currentLoopData = $artisans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $artisan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($artisan->id); ?>" <?php echo e(old('artisan_id') == $artisan->id ? 'selected' : ''); ?>>
                                    <?php echo e($artisan->user->name); ?> - <?php echo e($artisan->shop_name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    <?php endif; ?>

                    <?php $__errorArgs = ['artisan_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- TÍTULO -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-heading mr-2 text-indigo-500"></i>Título
                    </label>
                    <input 
                        id="title" 
                        name="title" 
                        type="text" 
                        required 
                        placeholder="Ejemplo: Mesa de Madera Personalizada"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        value="<?php echo e(old('title')); ?>"
                    >
                    <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- DESCRIPCIÓN -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-align-left mr-2 text-indigo-500"></i>Descripción
                    </label>
                    <textarea 
                        id="description" 
                        name="description" 
                        required 
                        rows="4"
                        placeholder="Detalla los requisitos del proyecto..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    ><?php echo e(old('description')); ?></textarea>
                    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- PRECIO (OPCIONAL) -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-dollar-sign mr-2 text-indigo-500"></i>Precio estimado (opcional)
                    </label>
                    <input 
                        type="number" 
                        step="0.01" 
                        name="price" 
                        id="price"
                        placeholder="450.00" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        value="<?php echo e(old('price')); ?>"
                    >
                    <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <!-- BOTÓN ENVIAR -->
            <button 
                type="submit" 
                class="w-full flex justify-center py-4 px-4 border border-transparent text-lg font-medium rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition shadow-lg"
            >
                <i class="fas fa-paper-plane mr-2"></i>
                Publicar Proyecto
            </button>
        </form>

        <!-- VOLVER -->
        <div class="mt-6 text-center">
            <a href="<?php echo e(route('projects.index')); ?>" class="text-indigo-600 hover:text-indigo-500 font-medium flex items-center justify-center">
                <i class="fas fa-arrow-left mr-2"></i>Volver a la Lista
            </a>
        </div>
    </div>
</body>
</html><?php /**PATH D:\ArtesanosJunin2025\resources\views/projects/publish.blade.php ENDPATH**/ ?>