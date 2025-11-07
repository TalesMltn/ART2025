<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Perfil - Plataforma Artesanos Junín</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-teal-50 to-green-100 min-h-screen flex items-center justify-center py-12 px-4">
    <div class="max-w-2xl w-full bg-white p-10 rounded-2xl shadow-2xl">
        <div class="text-center mb-8">
            <div class="mx-auto h-20 w-20 bg-teal-500 rounded-full flex items-center justify-center">
                <i class="fas fa-user-plus text-3xl text-white"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-900">Crear Perfil</h1>
            <p class="text-gray-600">Completa tu información</p>
        </div>

        <form method="POST" action="<?php echo e(route('profile.store')); ?>" class="space-y-6">
            <?php echo csrf_field(); ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-map-marker-alt mr-2 text-teal-500"></i>Dirección
                    </label>
                    <input type="text" name="address" required
                           class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-teal-500 <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           placeholder="Av. Principal 123, Junín"
                           value="<?php echo e(old('address')); ?>">
                    <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-sm text-red-600 mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <?php if(auth()->user()->role === 'artisan'): ?>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-store mr-2 text-teal-500"></i>Nombre del Taller
                    </label>
                    <input type="text" name="shop_name" required
                           class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-teal-500 <?php $__errorArgs = ['shop_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           placeholder="Taller de Cerámica Junín"
                           value="<?php echo e(old('shop_name')); ?>">
                    <?php $__errorArgs = ['shop_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-sm text-red-600 mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-info-circle mr-2 text-teal-500"></i>Biografía
                    </label>
                    <textarea name="bio" required rows="3"
                              class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-teal-500 <?php $__errorArgs = ['bio'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                              placeholder="Cuéntanos sobre tu arte..."><?php echo e(old('bio')); ?></textarea>
                    <?php $__errorArgs = ['bio'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-sm text-red-600 mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-university mr-2 text-teal-500"></i>Detalles Bancarios (Opcional)
                    </label>
                    <textarea name="bank_details" rows="2"
                              class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-teal-500 <?php $__errorArgs = ['bank_details'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                              placeholder="Cuenta BCP: 123-4567890-1-23"><?php echo e(old('bank_details')); ?></textarea>
                </div>
                <?php endif; ?>

                
                <?php if(auth()->user()->role === 'client'): ?>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-phone mr-2 text-teal-500"></i>Teléfono
                    </label>
                    <input type="text" name="phone" required
                           class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-teal-500 <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           placeholder="987654321"
                           value="<?php echo e(old('phone')); ?>">
                    <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-sm text-red-600 mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <?php endif; ?>
            </div>

            <div class="flex space-x-4 mt-6">
                <a href="<?php echo e(route('home')); ?>"
                   class="flex-1 py-4 px-6 bg-gray-600 hover:bg-gray-700 text-white font-bold rounded-xl transition shadow-lg flex items-center justify-center group">
                    <i class="fas fa-home mr-2 group-hover:-translate-x-1 transition"></i>
                    Volver
                </a>

                <button type="submit"
                        class="flex-1 py-4 px-6 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-xl transition shadow-lg flex items-center justify-center group">
                    <i class="fas fa-save mr-2 group-hover:scale-110 transition"></i>
                    Guardar Perfil
                </button>
            </div>

            <?php if(session('success')): ?>
                <div class="mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-xl text-center">
                    <i class="fas fa-check-circle mr-2"></i> <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>
        </form>
    </div>
</body>
</html><?php /**PATH D:\ArtesanosJunin2025\resources\views/profiles/create.blade.php ENDPATH**/ ?>