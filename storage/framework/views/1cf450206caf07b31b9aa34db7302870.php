<!-- resources/views/profiles/show.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - Plataforma Artesanos Junín</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-teal-50 to-green-100 min-h-screen flex items-center justify-center py-12 px-4">
    <div class="max-w-2xl w-full bg-white p-10 rounded-2xl shadow-2xl">
        <div class="text-center mb-8">
            <div class="mx-auto h-20 w-20 bg-teal-500 rounded-full flex items-center justify-center">
                <i class="fas fa-user text-3xl text-white"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-900">
                <?php echo e($profile->shop_name ?? $user->name); ?>

            </h1>
            <p class="text-lg text-gray-600 capitalize"><?php echo e($user->role); ?></p>
        </div>

        <div class="space-y-6">
            <?php if($user->role === 'artisan'): ?>
            <div>
                <h3 class="text-lg font-medium text-gray-700 flex items-center">
                    <i class="fas fa-info-circle mr-2 text-teal-500"></i>Biografía
                </h3>
                <p class="mt-2 text-gray-600"><?php echo e($profile->bio ?? 'Sin biografía'); ?></p>
            </div>
            <?php endif; ?>

            <div>
                <h3 class="text-lg font-medium text-gray-700 flex items-center">
                    <i class="fas fa-map-marker-alt mr-2 text-teal-500"></i>Dirección
                </h3>
                <p class="mt-2 text-gray-600"><?php echo e($profile->address); ?></p>
            </div>

            <?php if($user->role === 'artisan'): ?>
            <div>
                <h3 class="text-lg font-medium text-gray-700 flex items-center">
                    <i class="fas fa-university mr-2 text-teal-500"></i>Detalles Bancarios
                </h3>
                <p class="mt-2 text-gray-600"><?php echo e($profile->bank_details ?? 'No especificado'); ?></p>
            </div>
            <?php endif; ?>

            <?php if($user->role === 'client'): ?>
            <div>
                <h3 class="text-lg font-medium text-gray-700 flex items-center">
                    <i class="fas fa-phone mr-2 text-teal-500"></i>Teléfono
                </h3>
                <p class="mt-2 text-gray-600"><?php echo e($profile->phone); ?></p>
            </div>
            <?php endif; ?>
        </div>

        <div class="flex justify-between mt-8 gap-4">
            <a href="<?php echo e(route('profile.edit')); ?>"
               class="flex-1 inline-flex justify-center items-center px-5 py-3 bg-teal-600 hover:bg-teal-700 text-white font-medium rounded-xl transition shadow-lg">
                <i class="fas fa-edit mr-2"></i> Editar Perfil
            </a>

            <a href="<?php echo e(route('home')); ?>"
               class="flex-1 inline-flex justify-center items-center px-5 py-3 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-xl transition shadow-lg">
                <i class="fas fa-home mr-2"></i> Volver al Inicio
            </a>
        </div>

        <?php if(session('success')): ?>
            <div class="mt-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-xl text-center">
                <i class="fas fa-check-circle mr-2"></i> <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
    </div>
</body>
</html><?php /**PATH D:\ArtesanosJunin2025\resources\views/profiles/show.blade.php ENDPATH**/ ?>