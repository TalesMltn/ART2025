<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Plataforma Artesanos Junín</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Fondo con tu imagen soll.png */
        body {
            background-image: url('<?php echo e(asset('images/soll.png')); ?>');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            position: relative;
        }

        /* Overlay degradado cálido (artesanal) */
        .overlay {
            background: linear-gradient(135deg, 
                rgba(194, 134, 69, 0.75) 0%,   /* tono tierra cálido */
                rgba(139, 69, 19, 0.6) 50%,   /* marrón andino */
                rgba(101, 67, 33, 0.8) 100%    /* café profundo */
            );
        }

        /* Efecto de papel artesanal sutil */
        .form-card {
            background: rgba(255, 255, 255, 0.94);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        /* Animación de entrada */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeInUp {
            animation: fadeInUp 0.7s ease-out;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    
    <!-- Overlay degradado -->
    <div class="overlay w-full h-full absolute top-0 left-0"></div>

    <!-- Tarjeta de login -->
    <div class="relative z-10 max-w-md w-full form-card p-10 rounded-3xl animate-fadeInUp">
        
        <!-- Mensaje de éxito -->
        <?php if(session('success')): ?>
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 text-center text-sm">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <!-- Logo / Ícono -->
        <div class="text-center mb-8">
            <div class="mx-auto h-24 w-24 bg-gradient-to-br from-amber-500 to-orange-600 rounded-3xl flex items-center justify-center shadow-xl mb-6 transform hover:scale-105 transition">
                <i class="fas fa-hands-helping text-4xl text-white"></i>
            </div>
            <h2 class="text-3xl font-bold text-[#5a2d0c]">Artesanos Junín</h2>
            <p class="mt-2 text-sm text-amber-700">Tradición, cultura y pasión</p>
        </div>

        <!-- Formulario -->
        <form method="POST" action="<?php echo e(route('login')); ?>" class="space-y-6">
            <?php echo csrf_field(); ?>

            <!-- Email -->
            <div>
                <label class="flex items-center text-sm font-semibold text-[#5a2d0c] mb-2">
                    <i class="fas fa-envelope mr-2 text-amber-600"></i> Correo Electrónico
                </label>
                <input 
                    id="email" 
                    name="email" 
                    type="email" 
                    required 
                    value="<?php echo e(old('email')); ?>"
                    class="w-full px-5 py-3.5 rounded-xl border border-amber-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-100 transition placeholder:text-amber-400"
                    placeholder="tú@ejemplo.com"
                >
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-xs text-red-600 pl-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Contraseña -->
            <div>
                <label class="flex items-center text-sm font-semibold text-[#5a2d0c] mb-2">
                    <i class="fas fa-lock mr-2 text-amber-600"></i> Contraseña
                </label>
                <input 
                    id="password" 
                    name="password" 
                    type="password" 
                    required 
                    class="w-full px-5 py-3.5 rounded-xl border border-amber-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-100 transition"
                    placeholder="••••••••"
                >
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-xs text-red-600 pl-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Botón -->
            <button 
                type="submit" 
                class="w-full bg-gradient-to-r from-[#5a2d0c] to-[#7a3f10] text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition duration-200 flex items-center justify-center gap-3"
            >
                <i class="fas fa-sign-in-alt"></i>
                Iniciar Sesión
            </button>
        </form>

        <!-- Registro -->
        <div class="mt-8 text-center">
            <p class="text-sm text-amber-800">
                ¿Eres nuevo? 
                <a href="<?php echo e(route('register')); ?>" 
                   class="font-bold text-[#5a2d0c] hover:text-[#7a3f10] hover:underline">
                   Crea tu cuenta aquí
                </a>
            </p>
        </div>
    </div>
</body>
</html><?php /**PATH D:\ArtesanosJunin2025\resources\views/auth/login.blade.php ENDPATH**/ ?>