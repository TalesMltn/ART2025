<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Mensajes</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-teal-50 to-green-100 min-h-screen py-12 px-4">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl p-6">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-teal-800">Mis Conversaciones</h1>
                <a href="{{ route('artisans.index') }}" class="text-teal-600 hover:text-teal-800">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
            </div>

            @if(count($conversations) > 0)
                <div class="space-y-4">
                    @foreach($conversations as $conv)
                    <a href="{{ route('messages.send.form', $conv['user']->id) }}" 
                       class="block p-4 bg-teal-50 hover:bg-teal-100 rounded-xl transition flex items-center space-x-4">
                        <div class="w-12 h-12 bg-teal-500 rounded-full flex items-center justify-center text-white font-bold">
                            {{ strtoupper(substr($conv['user']->name, 0, 2)) }}
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-800">{{ $conv['user']->name }}</h3>
                            <p class="text-sm text-gray-600">{{ Str::limit($conv['last_message']->content, 50) }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-500">{{ $conv['last_message']->created_at->format('d/m H:i') }}</p>
                            @if($conv['unread_count'] > 0)
                                <span class="inline-block w-6 h-6 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">
                                    {{ $conv['unread_count'] }}
                                </span>
                            @endif
                        </div>
                    </a>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-envelope-open text-6xl text-teal-200 mb-4"></i>
                    <p class="text-lg text-gray-600">Aún no tienes mensajes</p>
                    <a href="{{ route('artisans.index') }}" class="mt-4 inline-block text-teal-600 hover:underline">
                        Explorar artesanos
                    </a>
                </div>
            @endif
        </div>
    </div>
</body>
</html>