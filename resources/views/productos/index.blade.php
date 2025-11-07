@extends('layouts.app')

@section('title', 'Lista de Productos')

@section('content')
<div class="container mx-auto px-6 py-12">
    <h1 class="text-4xl font-bold text-center mb-12 text-[#5a2d0c]">Categorías de Productos Artesanales</h1>

    <div class="grid md:grid-cols-3 gap-8">
        <!-- Textiles y tejidos -->
        <a href="{{ route('productos.categoria', 'textiles-y-tejidos') }}" class="block bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:bg-yellow-50">
            <img src="{{ asset('images/1n.png') }}" alt="Textiles y tejidos" class="w-full h-40 object-cover rounded-lg mb-4">
            <h2 class="text-2xl font-bold mb-3 text-center text-[#5a2d0c]">Textiles y tejidos</h2>
            <p class="text-center text-gray-700">
                Ponchos, mantas, chullos, bufandas y otros productos en lana de alpaca o oveja con técnicas tradicionales de tejido y bordado.
            </p>
        </a>
    
        <!-- Cerámica -->
        <a href="{{ route('productos.categoria', 'ceramica') }}" class="block bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:bg-yellow-50">
            <img src="{{ asset('images/2n.png') }}" alt="Cerámica" class="w-full h-40 object-cover rounded-lg mb-4">
            <h2 class="text-2xl font-bold mb-3 text-center text-[#5a2d0c]">Cerámica</h2>
            <p class="text-center text-gray-700">
                Piezas utilitarias o decorativas hechas en barro, como vasijas, ollas, figuras rituales y souvenirs.
            </p>
        </a>
    
        <!-- Madera tallada -->
        <a href="{{ route('productos.categoria', 'madera-tallada') }}" class="block bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:bg-yellow-50">
            <img src="{{ asset('images/3n.png') }}" alt="Madera tallada" class="w-full h-40 object-cover rounded-lg mb-4">
            <h2 class="text-2xl font-bold mb-3 text-center text-[#5a2d0c]">Madera tallada</h2>
            <p class="text-center text-gray-700">
                Artesanía en madera que incluye muebles pequeños, utensilios, figuras decorativas y esculturas.
            </p>
        </a>
    
        <!-- Mates burilados -->
        <a href="{{ route('productos.categoria', 'mates-burilados') }}" class="block bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:bg-yellow-50">
            <img src="{{ asset('images/4n.png') }}" alt="Mates burilados" class="w-full h-40 object-cover rounded-lg mb-4">
            <h2 class="text-2xl font-bold mb-3 text-center text-[#5a2d0c]">Mates burilados</h2>
            <p class="text-center text-gray-700">
                Mates de calabaza grabados a mano con diseños geométricos, culturales o escenas de la vida local.
            </p>
        </a>
    
        <!-- Joyería y bisutería artesanal -->
        <a href="{{ route('productos.categoria', 'joyeria-bisuteria') }}" class="block bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:bg-yellow-50">
            <img src="{{ asset('images/5n.png') }}" alt="Joyería y bisutería" class="w-full h-40 object-cover rounded-lg mb-4">
            <h2 class="text-2xl font-bold mb-3 text-center text-[#5a2d0c]">Joyería y bisutería artesanal</h2>
            <p class="text-center text-gray-700">
                Collares, pulseras, anillos y aretes hechos con plata, piedras semipreciosas o materiales naturales.
            </p>
        </a>
    
        <!-- Cuero y talabartería -->
        <a href="{{ route('productos.categoria', 'cuero-talabarteria') }}" class="block bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:bg-yellow-50">
            <img src="{{ asset('images/6n.png') }}" alt="Cuero y talabartería" class="w-full h-40 object-cover rounded-lg mb-4">
            <h2 class="text-2xl font-bold mb-3 text-center text-[#5a2d0c]">Cuero y talabartería</h2>
            <p class="text-center text-gray-700">
                Bolsos, carteras, cinturones, zapatos y accesorios hechos de cuero trabajado artesanalmente.
            </p>
        </a>
    
        <!-- Cestería y fibras vegetales -->
        <a href="{{ route('productos.categoria', 'cesteria-fibras-vegetales') }}" class="block bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:bg-yellow-50">
            <img src="{{ asset('images/7n.png') }}" alt="Cestería y fibras vegetales" class="w-full h-40 object-cover rounded-lg mb-4">
            <h2 class="text-2xl font-bold mb-3 text-center text-[#5a2d0c]">Cestería y fibras vegetales</h2>
            <p class="text-center text-gray-700">
                Canastas, sombreros, tapices, adornos y utensilios hechos con fibras vegetales como totora, paja o palma.
            </p>
        </a>
    
        <!-- Instrumentos musicales tradicionales -->
        <a href="{{ route('productos.categoria', 'instrumentos-musicales') }}" class="block bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:bg-yellow-50">
            <img src="{{ asset('images/8n.png') }}" alt="Instrumentos musicales tradicionales" class="w-full h-40 object-cover rounded-lg mb-4">
            <h2 class="text-2xl font-bold mb-3 text-center text-[#5a2d0c]">Instrumentos musicales tradicionales</h2>
            <p class="text-center text-gray-700">
                Flautas de caña, charangos, bombos y otros instrumentos típicos elaborados por artesanos locales.
            </p>
        </a>
    
        <!-- Arte decorativo y souvenir -->
        <a href="{{ route('productos.categoria', 'arte-decorativo') }}" class="block bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:bg-yellow-50">
            <img src="{{ asset('images/9n.png') }}" alt="Arte decorativo y souvenir" class="w-full h-40 object-cover rounded-lg mb-4">
            <h2 class="text-2xl font-bold mb-3 text-center text-[#5a2d0c]">Arte decorativo y souvenir</h2>
            <p class="text-center text-gray-700">
                Figurillas, esculturas, adornos y recuerdos representativos de la cultura y tradición de la región.
            </p>
        </a>
    </div>

        <!-- BOTÓN VOLVER AL INICIO -->
        <div class="mt-12 text-center">
            <a href="{{ url('/') }}" 
            class="inline-flex items-center bg-[#5a2d0c] text-white font-semibold px-6 py-3 rounded-lg shadow-md hover:bg-[#7a3f10] transition duration-300">
                <i class="fas fa-arrow-left mr-2"></i> Volver al Inicio
            </a>
        </div>
</div>
@endsection