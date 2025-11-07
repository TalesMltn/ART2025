<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Plataforma Artesanos Junín'); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    
    <nav class="bg-white shadow-md p-4 mb-6">
        <div class="container mx-auto flex justify-between items-center">
            <a href="<?php echo e(route('home')); ?>" class="text-2xl font-bold text-indigo-600">Artesanos Junín</a>
            <div class="flex items-center space-x-6">
                <?php if(auth()->guard()->check()): ?>
                    <span class="text-gray-700">Hola, <?php echo e(Auth::user()->name); ?></span>
                    <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="text-red-600 hover:text-red-800 hover:underline font-medium">
                            Cerrar Sesión
                        </button>
                    </form>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="text-indigo-600 hover:underline">Iniciar Sesión</a>
                    <a href="<?php echo e(route('register')); ?>" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Registrarse</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    
    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    
    <footer class="bg-gray-800 text-white p-6 mt-12">
        <div class="container mx-auto text-center">
            <p>© 2025 Plataforma Artesanos Junín. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html><?php /**PATH D:\ArtesanosJunin2025\resources\views/layouts/app.blade.php ENDPATH**/ ?>