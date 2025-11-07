<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar Mensaje a <?php echo e($artisan->user->name); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-teal-50 to-green-100 min-h-screen py-12 px-4">
    <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-xl p-8">
        <div class="flex items-center mb-6">
            <a href="<?php echo e(route('artisans.profile', $artisan)); ?>" class="text-teal-600 hover:text-teal-800">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
            <h1 class="text-2xl font-bold text-gray-900 ml-4">Contactar a <?php echo e($artisan->user->name); ?></h1>
        </div>

        <form method="POST" action="<?php echo e(route('messages.send', $artisan->user_id)); ?>" class="space-y-6">
            <?php echo csrf_field(); ?>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Mensaje</label>
                <textarea name="content" rows="6" required
                          class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-teal-500 <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                          placeholder="Escribe tu consulta..."><?php echo e(old('content')); ?></textarea>
                <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-sm text-red-600 mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="flex space-x-4">
                <a href="<?php echo e(route('artisans.profile', $artisan)); ?>" 
                   class="flex-1 py-3 px-6 bg-gray-500 text-white rounded-xl text-center hover:bg-gray-600 transition">
                    Cancelar
                </a>
                <button type="submit" 
                        class="flex-1 py-3 px-6 bg-teal-600 text-white rounded-xl hover:bg-teal-700 transition">
                    Enviar Mensaje
                </button>
            </div>
        </form>

        <?php if(session('success')): ?>
            <div class="mt-4 p-4 bg-green-100 text-green-700 rounded-xl text-center">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
    </div>
</body>
</html><?php /**PATH D:\ArtesanosJunin2025\resources\views/messages/send.blade.php ENDPATH**/ ?>