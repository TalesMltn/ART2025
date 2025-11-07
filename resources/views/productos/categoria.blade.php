@extends('layouts.app')

@section('title', ucfirst(str_replace('-', ' ', $slug)))

@section('content')
<div class="flex flex-col min-h-screen bg-gradient-to-b from-yellow-50 to-white">

    <!-- CONTENIDO PRINCIPAL -->
    <div class="flex-grow container mx-auto px-6 py-12">
        <h1 class="text-4xl font-bold text-center mb-10 text-[#5a2d0c] flex items-center justify-center gap-3">
            @if($slug === 'textiles-y-tejidos') yarn
            @elseif($slug === 'ceramica') pottery
            @elseif($slug === 'madera-tallada') wood
            @elseif($slug === 'mates-burilados') flower
            @elseif($slug === 'joyeria-bisuteria') ring
            @elseif($slug === 'cuero-talabarteria') shoe
            @elseif($slug === 'cesteria-fibras-vegetales') seed
            @elseif($slug === 'instrumentos-musicales') music
            @elseif($slug === 'arte-decorativo') image
            @endif
            {{ ucfirst(str_replace('-', ' ', $slug)) }}
        </h1>

        <div class="grid md:grid-cols-3 gap-8">

            <!-- TEXTILES Y TEJIDOS -->
            @if($slug === 'textiles-y-tejidos')
                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:bg-yellow-50 text-center">
                    <img src="{{ asset('images/textiles/poncho.jpg') }}" alt="Poncho" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h2 class="text-xl font-bold text-[#5a2d0c]">Ponchos</h2>
                    <p class="text-sm text-gray-600 mt-2">Hechos con lana de alpaca o oveja, ideales para el frío andino.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:bg-yellow-50 text-center">
                    <img src="{{ asset('images/textiles/manta.jpg') }}" alt="Manta" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h2 class="text-xl font-bold text-[#5a2d0c]">Mantas</h2>
                    <p class="text-sm text-gray-600 mt-2">Tejidas en telar con diseños geométricos tradicionales.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:bg-yellow-50 text-center">
                    <img src="{{ asset('images/textiles/chullo.jpg') }}" alt="Chullo" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h2 class="text-xl font-bold text-[#5a2d0c]">Chullos</h2>
                    <p class="text-sm text-gray-600 mt-2">Gorros con orejeras, 100% lana y colores naturales.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:bg-yellow-50 text-center">
                    <img src="{{ asset('images/textiles/bufanda.jpg') }}" alt="Bufanda" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h2 class="text-xl font-bold text-[#5a2d0c]">Bufandas</h2>
                    <p class="text-sm text-gray-600 mt-2">Suaves, cálidas y tejidas a mano.</p>
                </div>

            <!-- CERÁMICA -->
            @elseif($slug === 'ceramica')
                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:bg-yellow-50 text-center">
                    <img src="{{ asset('images/ceramica/vasija.jpg') }}" alt="Vasija" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h2 class="text-xl font-bold text-[#5a2d0c]">Vasijas</h2>
                    <p class="text-sm text-gray-600 mt-2">De arcilla cocida, con motivos prehispánicos.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:bg-yellow-50 text-center">
                    <img src="{{ asset('images/ceramica/olla.jpg') }}" alt="Olla" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h2 class="text-xl font-bold text-[#5a2d0c]">Ollas</h2>
                    <p class="text-sm text-gray-600 mt-2">Perfectas para cocinar a fuego lento.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:bg-yellow-50 text-center">
                    <img src="{{ asset('images/ceramica/torito.jpg') }}" alt="Figura ritual" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h2 class="text-xl font-bold text-[#5a2d0c]">Figuras rituales</h2>
                    <p class="text-sm text-gray-600 mt-2">Toritos de Pucará, símbolos de protección.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:bg-yellow-50 text-center">
                    <img src="{{ asset('images/ceramica/souvenir.jpg') }}" alt="Souvenir" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h2 class="text-xl font-bold text-[#5a2d0c]">Souvenirs</h2>
                    <p class="text-sm text-gray-600 mt-2">Miniaturas decorativas de cerámica.</p>
                </div>

            <!-- MADERA TALLADA -->
            @elseif($slug === 'madera-tallada')
                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:bg-yellow-50 text-center">
                    <img src="{{ asset('images/madera/mueble.jpg') }}" alt="Mueble pequeño" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h2 class="text-xl font-bold text-[#5a2d0c]">Muebles pequeños</h2>
                    <p class="text-sm text-gray-600 mt-2">Mesitas, banquitos y repisas talladas.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:bg-yellow-50 text-center">
                    <img src="{{ asset('images/madera/utensilio.jpg') }}" alt="Utensilio" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h2 class="text-xl font-bold text-[#5a2d0c]">Utensilios</h2>
                    <p class="text-sm text-gray-600 mt-2">Cucharas, morteros y tablas de madera.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:bg-yellow-50 text-center">
                    <img src="{{ asset('images/madera/figura.jpg') }}" alt="Figura decorativa" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h2 class="text-xl font-bold text-[#5a2d0c]">Figuras decorativas</h2>
                    <p class="text-sm text-gray-600 mt-2">Animales, dioses andinos y máscaras.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:bg-yellow-50 text-center">
                    <img src="{{ asset('images/madera/escultura.jpg') }}" alt="Escultura" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h2 class="text-xl font-bold text-[#5a2d0c]">Esculturas</h2>
                    <p class="text-sm text-gray-600 mt-2">Piezas únicas talladas a mano.</p>
                </div>

            <!-- MATES BURILADOS -->
            @elseif($slug === 'mates-burilados')
                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:bg-yellow-50 text-center col-span-full md:col-span-1">
                    <img src="{{ asset('images/mates/burilado.jpg') }}" alt="Mate burilado" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h2 class="text-xl font-bold text-[#5a2d0c]">Mates de calabaza grabados a mano</h2>
                    <p class="text-sm text-gray-600 mt-2">Escenas de la vida andina, naturaleza y tradiciones.</p>
                </div>

            <!-- JOYERÍA Y BISUTERÍA -->
            @elseif($slug === 'joyeria-bisuteria')
                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:bg-yellow-50 text-center">
                    <img src="{{ asset('images/joyeria/collar.jpg') }}" alt="Collar" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h2 class="text-xl font-bold text-[#5a2d0c]">Collares</h2>
                    <p class="text-sm text-gray-600 mt-2">Plata 950, piedras naturales y semillas.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:bg-yellow-50 text-center">
                    <img src="{{ asset('images/joyeria/pulsera.jpg') }}" alt="Pulsera" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h2 class="text-xl font-bold text-[#5a2d0c]">Pulseras</h2>
                    <p class="text-sm text-gray-600 mt-2">Diseños con chakanas, soles y lunas.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:bg-yellow-50 text-center">
                    <img src="{{ asset('images/joyeria/anillo.jpg') }}" alt="Anillo" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h2 class="text-xl font-bold text-[#5a2d0c]">Anillos</h2>
                    <p class="text-sm text-gray-600 mt-2">Hechos con plata y piedras semipreciosas.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:bg-yellow-50 text-center">
                    <img src="{{ asset('images/joyeria/aretes.jpg') }}" alt="Aretes" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h2 class="text-xl font-bold text-[#5a2d0c]">Aretes</h2>
                    <p class="text-sm text-gray-600 mt-2">Ligeros y con detalles artesanales.</p>
                </div>

            <!-- CUERO Y TALABARTERÍA -->
            @elseif($slug === 'cuero-talabarteria')
                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:bg-yellow-50 text-center">
                    <img src="{{ asset('images/cuero/bolso.jpg') }}" alt="Bolso" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h2 class="text-xl font-bold text-[#5a2d0c]">Bolsos</h2>
                    <p class="text-sm text-gray-600 mt-2">Cuero curtido vegetal, cosido a mano.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:bg-yellow-50 text-center">
                    <img src="{{ asset('images/cuero/cartera.jpg') }}" alt="Cartera" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h2 class="text-xl font-bold text-[#5a2d0c]">Carteras</h2>
                    <p class="text-sm text-gray-600 mt-2">Diseños prácticos y duraderos.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:bg-yellow-50 text-center">
                    <img src="{{ asset('images/cuero/cinturon.jpg') }}" alt="Cinturón" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h2 class="text-xl font-bold text-[#5a2d0c]">Cinturones</h2>
                    <p class="text-sm text-gray-600 mt-2">Con hebillas de bronce o alpaca.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:bg-yellow-50 text-center">
                    <img src="{{ asset('images/cuero/zapato.jpg') }}" alt="Zapato" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h2 class="text-xl font-bold text-[#5a2d0c]">Zapatos</h2>
                    <p class="text-sm text-gray-600 mt-2">Estilo tradicional o moderno en cuero.</p>
                </div>

            <!-- CESTERÍA Y FIBRAS VEGETALES -->
            @elseif($slug === 'cesteria-fibras-vegetales')
                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:bg-yellow-50 text-center">
                    <img src="{{ asset('images/cesteria/canasta.jpg') }}" alt="Canasta" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h2 class="text-xl font-bold text-[#5a2d0c]">Canastas</h2>
                    <p class="text-sm text-gray-600 mt-2">De totora, paja o ichu, tejidas a mano.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:bg-yellow-50 text-center">
                    <img src="{{ asset('images/cesteria/sombrero.jpg') }}" alt="Sombrero" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h2 class="text-xl font-bold text-[#5a2d0c]">Sombreros</h2>
                    <p class="text-sm text-gray-600 mt-2">Protección solar y estilo andino.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:bg-yellow-50 text-center">
                    <img src="{{ asset('images/cesteria/tapiz.jpg') }}" alt="Tapiz" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h2 class="text-xl font-bold text-[#5a2d0c]">Tapices</h2>
                    <p class="text-sm text-gray-600 mt-2">Decoración mural con fibras naturales.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:bg-yellow-50 text-center">
                    <img src="{{ asset('images/cesteria/adorno.jpg') }}" alt="Adorno" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h2 class="text-xl font-bold text-[#5a2d0c]">Adornos y utensilios</h2>
                    <p class="text-sm text-gray-600 mt-2">Pequeños objetos funcionales y bellos.</p>
                </div>

            <!-- INSTRUMENTOS MUSICALES -->
            @elseif($slug === 'instrumentos-musicales')
                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:bg-yellow-50 text-center">
                    <img src="{{ asset('images/instrumentos/flauta.jpg') }}" alt="Flauta de caña" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h2 class="text-xl font-bold text-[#5a2d0c]">Flautas de caña</h2>
                    <p class="text-sm text-gray-600 mt-2">Sonido puro y tradicional andino.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:bg-yellow-50 text-center">
                    <img src="{{ asset('images/instrumentos/charango.jpg') }}" alt="Charango" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h2 class="text-xl font-bold text-[#5a2d0c]">Charangos</h2>
                    <p class="text-sm text-gray-600 mt-2">Cuerpo de quirquincho o madera tallada.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:bg-yellow-50 text-center">
                    <img src="{{ asset('images/instrumentos/bombo.jpg') }}" alt="Bombo" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h2 class="text-xl font-bold text-[#5a2d0c]">Bombos</h2>
                    <p class="text-sm text-gray-600 mt-2">Percusión profunda para fiestas tradicionales.</p>
                </div>

            <!-- ARTE DECORATIVO Y SOUVENIR -->
            @elseif($slug === 'arte-decorativo')
                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:bg-yellow-50 text-center">
                    <img src="{{ asset('images/arte/figurilla.jpg') }}" alt="Figurilla" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h2 class="text-xl font-bold text-[#5a2d0c]">Figurillas</h2>
                    <p class="text-sm text-gray-600 mt-2">Personajes, animales y dioses en miniatura.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:bg-yellow-50 text-center">
                    <img src="{{ asset('images/arte/escultura.jpg') }}" alt="Escultura" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h2 class="text-xl font-bold text-[#5a2d0c]">Esculturas</h2>
                    <p class="text-sm text-gray-600 mt-2">Piezas de arte en madera, piedra o arcilla.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:bg-yellow-50 text-center">
                    <img src="{{ asset('images/arte/adorno.jpg') }}" alt="Adorno" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h2 class="text-xl font-bold text-[#5a2d0c]">Adornos</h2>
                    <p class="text-sm text-gray-600 mt-2">Detalles para el hogar con alma andina.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:bg-yellow-50 text-center">
                    <img src="{{ asset('images/arte/recuerdo.jpg') }}" alt="Recuerdo" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h2 class="text-xl font-bold text-[#5a2d0c]">Recuerdos</h2>
                    <p class="text-sm text-gray-600 mt-2">Souvenirs auténticos de la región.</p>
                </div>

            @else
                <p class="text-center text-gray-600 mt-12 col-span-full">No hay productos registrados en esta categoría todavía.</p>
            @endif

        </div>

        <!-- BOTÓN VOLVER -->
        <div class="mt-10 text-center">
            <a href="{{ route('productos.index') }}" 
               class="inline-flex items-center bg-[#5a2d0c] text-white font-semibold px-5 py-2.5 rounded-lg shadow-md hover:bg-[#7a3f10] transition">
                <i class="fas fa-arrow-left mr-2"></i> Volver a Categorías
            </a>
        </div>
    </div>
</div>
@endsection