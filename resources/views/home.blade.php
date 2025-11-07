{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('title', 'Artesanos Junín - Conexión de Empleo')

@section('content')

<!-- Hero principal -->
<section class="hero text-center py-16 bg-cover bg-center relative"
         style="background-image: url('{{ asset('images/inti.png') }}');">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="container mx-auto px-6 relative z-10">
        <div class="p-8 bg-white/95 rounded-2xl border shadow-lg hover:shadow-xl transition max-w-3xl mx-auto">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gray-900 leading-tight">
                Plataforma de Conexión de Empleo para Artesanos
            </h2>
            <p class="text-lg md:text-xl mb-8 leading-relaxed text-gray-700">
                Conecta con artesanos locales de la región Junín y encuentra proyectos únicos que impulsan la cultura y la economía regional.
            </p>
            <div class="flex justify-center gap-4">
                @auth
                    @if(Auth::user()->role === 'cliente')
                        <a href="{{ route('projects.index') }}" 
                           class="bg-[#5a2d0c] text-white font-bold py-3 px-6 rounded-xl hover:bg-[#8b4513] transition shadow-md">
                            Buscar Proyectos
                        </a>
                    @elseif(Auth::user()->role === 'artesano')
                        <a href="{{ route('projects.publish') }}" 
                           class="bg-[#8b4513] text-white font-bold py-3 px-6 rounded-xl hover:bg-[#a0522d] transition shadow-md">
                            Publicar Proyecto
                        </a>
                    @endif
                @else
                    <a href="{{ route('register') }}" 
                       class="bg-[#5a2d0c] text-white font-bold py-3 px-6 rounded-xl hover:bg-[#8b4513] transition shadow-md">
                        Únete Ahora
                    </a>
                @endauth
            </div>
        </div>
    </div>
</section>

<!-- SEPARADOR CURVO -->
<div class="relative -mt-1">
    <svg class="w-full h-16 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none">
        <path fill="currentColor" 
              d="M0,64L48,80C96,96,192,128,288,154.7C384,181,480,203,576,213.3C672,224,768,224,864,202.7C960,181,1056,139,1152,128C1248,117,1344,139,1392,149.3L1440,160V320H0Z">
        </path>
    </svg>
</div>

<!-- Ventajas principales -->
<section class="py-16 bg-cover bg-center bg-fixed"
         style="background-image: url('{{ asset('images/jarron.png') }}');">
    <div class="container mx-auto px-6">
        <h3 class="text-3xl font-semibold text-center mb-12 text-white drop-shadow-lg">
            Ventajas de nuestra plataforma
        </h3>

        <!-- Cambié a 4 columnas en pantallas grandes -->
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            
            <!-- Ventaja 1 -->
            <div class="flex flex-col justify-between p-6 bg-white/95 rounded-2xl border shadow-md hover:shadow-xl transition transform hover:-translate-y-1">
                <div>
                    <div class="w-12 h-12 bg-[#5a2d0c] rounded-full flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold mb-3 text-gray-800">Perfiles verificados</h4>
                    <p class="text-gray-700 mb-4">
                        Portafolios con evidencia real de habilidades, técnicas y obras, con protección básica de propiedad intelectual.
                    </p>
                </div>
                <a href="{{ route('artisans.index') }}" 
                   class="bg-[#5a2d0c] text-white font-bold py-2 px-4 rounded-xl hover:bg-[#8b4513] text-center mt-4 transition">
                    Explorar perfiles
                </a>
            </div>

            <!-- Ventaja 2 -->
            <div class="flex flex-col justify-between p-6 bg-white/95 rounded-2xl border shadow-md hover:shadow-xl transition transform hover:-translate-y-1">
                <div>
                    <div class="w-12 h-12 bg-[#8b4513] rounded-full flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold mb-3 text-gray-800">Proyectos rápidos</h4>
                    <p class="text-gray-700 mb-4">
                        Publica tus necesidades, recibe propuestas y administra contrataciones de manera segura y eficiente.
                    </p>
                </div>
                <a href="{{ route('projects.index') }}" 
                   class="bg-[#5a2d0c] text-white font-bold py-2 px-4 rounded-xl hover:bg-[#8b4513] text-center mt-4 transition">
                    Ver proyectos
                </a>
            </div>

            <!-- Ventaja 3 -->
            <div class="flex flex-col justify-between p-6 bg-white/95 rounded-2xl border shadow-md hover:shadow-xl transition transform hover:-translate-y-1">
                <div>
                    <div class="w-12 h-12 bg-[#a0522d] rounded-full flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold mb-3 text-gray-800">Valoraciones transparentes</h4>
                    <p class="text-gray-700 mb-4">
                        Califica trabajos completados y construye una reputación sólida en la comunidad de artesanos.
                    </p>
                </div>
                <a href="{{ route('ratings.index') }}" 
                   class="bg-[#5a2d0c] text-white font-bold py-2 px-4 rounded-xl hover:bg-[#8b4513] text-center mt-4 transition">
                    Mis Valoraciones
                </a>
            </div>

            <!-- Ventaja 4: Productos Artesanales -->
            <div class="flex flex-col justify-between p-6 bg-white/95 rounded-2xl border shadow-md hover:shadow-xl transition transform hover:-translate-y-1">
                <div>
                    <div class="w-12 h-12 bg-[#d2691e] rounded-full flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7h18M3 12h18M3 17h18"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold mb-3 text-gray-800">Productos Artesanales</h4>
                    <p class="text-gray-700 mb-4">
                        Explora categorías de artesanías de Junín: tejidos, cerámica, madera, joyería y más.
                    </p>
                </div>
                <a href="{{ route('productos.index') }}" 
                   class="bg-[#5a2d0c] text-white font-bold py-2 px-4 rounded-xl hover:bg-[#8b4513] text-center mt-4 transition">
                    Ver productos
                </a>
            </div>
        </div>
    </div>
</section>
<div class="text-center mt-16">
    <a href="{{ route('contacto.submit') }}" 
       class="inline-flex items-center bg-orange-600 text-white font-bold py-3 px-6 rounded-xl hover:bg-orange-700 transition shadow-md">
        <i class="fas fa-envelope mr-2"></i> Contáctanos
    </a>
</div>

@endsection
