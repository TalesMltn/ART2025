<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse - Plataforma Artesanos Junín</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Fondo con taurito.png */
        body {
            background-image: url('<?php echo e(asset('images/taurito.png')); ?>');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            position: relative;
        }

        /* Overlay degradado cálido andino */
        .overlay {
            background: linear-gradient(135deg,
                rgba(194, 134, 69, 0.78) 0%,
                rgba(139, 69, 19, 0.65) 50%,
                rgba(101, 67, 33, 0.85) 100%
            );
        }

        /* Tarjeta con efecto cristal */
        .form-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
        }

        /* Animación de entrada */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeInUp {
            animation: fadeInUp 0.8s ease-out;
        }

        /* Focus suave */
        input:focus, select:focus {
            transform: translateY(-1px);
            box-shadow: 0 0 0 4px rgba(180, 83, 9, 0.15);
        }

        /* Botón de ojo */
        .toggle-password {
            cursor: pointer;
            transition: color 0.2s;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    
    <!-- Overlay -->
    <div class="overlay w-full h-full absolute top-0 left-0"></div>

    <!-- Tarjeta de registro -->
    <div class="relative z-10 max-w-2xl w-full form-card p-10 rounded-3xl animate-fadeInUp">
        
        <!-- Logo / Ícono -->
        <div class="text-center mb-8">
            <div class="mx-auto h-24 w-24 bg-gradient-to-br from-amber-500 to-orange-600 rounded-3xl flex items-center justify-center shadow-xl mb-6 transform hover:scale-105 transition">
                <i class="fas fa-hands-helping text-4xl text-white"></i>
            </div>
            <h2 class="text-3xl font-bold text-[#5a2d0c]">Únete a la Comunidad</h2>
            <p class="mt-2 text-lg text-amber-700">Comparte tu arte con el mundo</p>
        </div>

        <!-- Formulario -->
        <form method="POST" action="<?php echo e(route('register')); ?>" class="mt-8 space-y-6">
            <?php echo csrf_field(); ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Columna 1: Datos Personales -->
                <div class="space-y-5">
                    <div>
                        <label class="flex items-center text-sm font-semibold text-[#5a2d0c] mb-2">
                            <i class="fas fa-user mr-2 text-amber-600"></i> Nombres Completos
                        </label>
                        <input 
                            id="name" 
                            name="name" 
                            type="text" 
                            required 
                            value="<?php echo e(old('name')); ?>"
                            class="w-full px-5 py-3.5 rounded-xl border border-amber-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-100 transition placeholder:text-amber-400"
                            placeholder="Juan Pérez"
                        >
                        <?php $__errorArgs = ['name'];
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
                            class="w-full px-5 py-3.5 rounded-xl border border-amber-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-100 transition"
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
                </div>

                <!-- Columna 2: Rol y Contraseña -->
                <div class="space-y-5">
                    <div>
                        <label class="flex items-center text-sm font-semibold text-[#5a2d0c] mb-2">
                            <i class="fas fa-user-tag mr-2 text-amber-600"></i> Tipo de Cuenta
                        </label>
                        <select 
                            id="role" 
                            name="role" 
                            required 
                            class="w-full px-5 py-3.5 rounded-xl border border-amber-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-100 transition bg-white"
                        >
                            <option value="">Selecciona tu rol</option>
                            <option value="client" <?php echo e(old('role') == 'client' ? 'selected' : ''); ?>>Cliente</option>
                            <option value="artisan" <?php echo e(old('role') == 'artisan' ? 'selected' : ''); ?>>Artesano</option>
                            <?php if(request()->has('admin')): ?>
                                <option value="admin" <?php echo e(old('role') == 'admin' ? 'selected' : ''); ?>>Administrador</option>
                            <?php endif; ?>
                        </select>
                        <?php $__errorArgs = ['role'];
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

                    <!-- Contraseña con ejemplo y toggle -->
                    <div class="relative">
                        <label class="flex items-center text-sm font-semibold text-[#5a2d0c] mb-2">
                            <i class="fas fa-lock mr-2 text-amber-600"></i> Contraseña
                        </label>
                        <input 
                            id="password" 
                            name="password" 
                            type="password" 
                            required 
                            minlength="8"
                            class="w-full px-5 py-3.5 rounded-xl border border-amber-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-100 transition pr-12"
                            placeholder="Ej: MiArtesania2025!"
                        >
                        <button 
                            type="button" 
                            onclick="togglePassword('password')"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-amber-600 hover:text-[#5a2d0c] toggle-password"
                        >
                            <i class="fas fa-eye"></i>
                        </button>
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

                    <!-- Confirmar Contraseña con ejemplo y toggle -->
                    <div class="relative">
                        <label class="flex items-center text-sm font-semibold text-[#5a2d0c] mb-2">
                            <i class="fas fa-lock mr-2 text-amber-600"></i> Confirmar Contraseña
                        </label>
                        <input 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            type="password" 
                            required
                            class="w-full px-5 py-3.5 rounded-xl border border-amber-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-100 transition pr-12"
                            placeholder="Repite: MiArtesania2025!"
                        >
                        <button 
                            type="button" 
                            onclick="togglePassword('password_confirmation')"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-amber-600 hover:text-[#5a2d0c] toggle-password"
                        >
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Botón -->
            <button 
                type="submit" 
                class="w-full bg-gradient-to-r from-[#5a2d0c] to-[#7a3f10] text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition duration-200 flex items-center justify-center gap-3 text-lg"
            >
                <i class="fas fa-user-plus"></i>
                Crear Mi Cuenta
            </button>
        </form>

        <!-- Login -->
        <div class="mt-8 text-center border-t pt-6">
            <p class="text-sm text-amber-800">
                ¿Ya tienes cuenta? 
                <a href="<?php echo e(route('login')); ?>" 
                   class="font-bold text-[#5a2d0c] hover:text-[#7a3f10] hover:underline">
                   Inicia sesión aquí
                </a>
            </p>
        </div>
    </div>

    <!-- JavaScript para mostrar/ocultar contraseña -->
    <script>
        function togglePassword(id) {
            const input = document.getElementById(id);
            const button = input.parentElement.querySelector('.toggle-password');
            const icon = button.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
</body>
</html><?php /**PATH D:\ArtesanosJunin2025\resources\views/auth/register.blade.php ENDPATH**/ ?>