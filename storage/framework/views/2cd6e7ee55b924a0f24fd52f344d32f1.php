<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Proyecto - Plataforma Artesanos Junín</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-purple-50 to-indigo-100 min-h-screen flex items-center justify-center py-12 px-4">
    <div class="max-w-2xl w-full bg-white p-10 rounded-2xl shadow-2xl">
        <div class="text-center mb-8">
            <div class="mx-auto h-20 w-20 bg-green-500 rounded-2xl flex items-center justify-center mb-4">
                <i class="fas fa-edit text-3xl text-white"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-900">Editar Proyecto</h2>
            <p class="text-sm text-gray-600">Solo tú puedes modificar este proyecto</p>
        </div>

        <form method="POST" action="<?php echo e(route('projects.update', $project)); ?>" class="space-y-6">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <!-- TÍTULO -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-heading mr-1"></i> Título
                </label>
                <input 
                    type="text" 
                    name="title" 
                    value="<?php echo e(old('title', $project->title)); ?>" 
                    required
                    class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-green-500 <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    placeholder="Ej: Mesa de madera tallada"
                >
                <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-600 text-sm mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- DESCRIPCIÓN -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-align-left mr-1"></i> Descripción
                </label>
                <textarea 
                    name="description" 
                    required 
                    rows="4"
                    class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-green-500 <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    placeholder="Detalles del trabajo..."
                ><?php echo e(old('description', $project->description)); ?></textarea>
                <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-600 text-sm mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- PRECIO -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-dollar-sign mr-1"></i> Precio acordado (S/)
                </label>
                <input 
                    type="number" 
                    step="0.01" 
                    name="price" 
                    value="<?php echo e(old('price', $project->price)); ?>"
                    placeholder="0.00"
                    class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-green-500 <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                >
                <p class="text-xs text-gray-500 mt-1">Deja vacío si aún no hay acuerdo</p>
                <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-600 text-sm mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- ESTADO -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-tasks mr-1"></i> Estado del Proyecto
                </label>
                <select 
                    name="status" 
                    required
                    class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-green-500 <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                >
                    <option value="pending" <?php echo e(old('status', $project->status) == 'pending' ? 'selected' : ''); ?>>
                        Pendiente (esperando aceptación)
                    </option>
                    <option value="active" <?php echo e(old('status', $project->status) == 'active' ? 'selected' : ''); ?>>
                        En Progreso
                    </option>
                    <option value="completed" <?php echo e(old('status', $project->status) == 'completed' ? 'selected' : ''); ?>>
                        Completado
                    </option>
                    <option value="cancelled" <?php echo e(old('status', $project->status) == 'cancelled' ? 'selected' : ''); ?>>
                        Cancelado
                    </option>
                </select>
                <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-600 text-sm mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- BOTÓN -->
            <button 
                type="submit"
                class="w-full bg-green-600 text-white py-3 rounded-xl hover:bg-green-700 transition font-semibold flex items-center justify-center"
            >
                <i class="fas fa-save mr-2"></i>
                Guardar Cambios
            </button>
        </form>

        <!-- VOLVER -->
        <div class="mt-6 text-center">
            <a href="<?php echo e(route('projects.index')); ?>" class="text-gray-600 hover:text-gray-800 text-sm flex items-center justify-center">
                <i class="fas fa-arrow-left mr-2"></i> Volver a mis proyectos
            </a>
        </div>
    </div>
</body>
</html><?php /**PATH D:\ArtesanosJunin2025\resources\views/projects/edit.blade.php ENDPATH**/ ?>