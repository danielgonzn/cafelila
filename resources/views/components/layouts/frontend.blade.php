<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $metaTitle = $settings['meta_title'] ?? 'CafeLila | Cafe Gourmet de Costa Rica';
        $metaDescription = $settings['meta_description'] ?? 'Cafe gourmet premium con estandar de calidad para socios comerciales.';
        $ogImage = !empty($settings['og_image'] ?? null) ? asset('storage/'.$settings['og_image']) : asset('favicon.ico');
        $logoImage = !empty($settings['logo_image'] ?? null) ? asset('storage/'.$settings['logo_image']) : null;
    @endphp

    <title>{{ $metaTitle }}</title>
    <meta name="description" content="{{ $metaDescription }}">
    <meta property="og:title" content="{{ $metaTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ $ogImage }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-black" x-data="{menu:false}">
    <header class="sticky top-0 z-40 bg-white/95 backdrop-blur border-b border-stone-200">
        <div class="container-shell h-24 flex items-center justify-between">
            <a href="#inicio" class="text-2xl font-bold tracking-tight text-[#562B05]">
                @if($logoImage)
                    <img src="{{ $logoImage }}" alt="CafeLila Logo" class="h-20 md:h-20 w-auto object-contain">
                @else
                    CafeLila
                @endif
            </a>

            <nav class="hidden md:flex items-center gap-7 text-sm font-medium">
                <a href="#inicio" class="hover:text-[#562B05]">Inicio</a>
                <a href="#nosotros" class="hover:text-[#562B05]">Nosotros</a>
                <a href="#productos" class="hover:text-[#562B05]">Productos</a>
                <a href="#ubicacion" class="hover:text-[#562B05]">Ubicacion</a>
                <a href="#contacto" class="hover:text-[#562B05]">Contacto</a>
                <a href="#faq" class="hover:text-[#562B05]">FAQ</a>
             
            </nav>

            <button @click="menu=!menu" class="md:hidden p-2 rounded-md border border-stone-300" aria-label="Abrir menu">
                <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
        <div class="md:hidden border-t border-stone-200" x-show="menu" x-transition>
            <div class="container-shell py-4 flex flex-col gap-3 text-sm">
                <a href="#inicio">Inicio</a>
                <a href="#nosotros">Nosotros</a>
                <a href="#productos">Productos</a>
                <a href="#ubicacion">Ubicacion</a>
                <a href="#contacto">Contacto</a>
                <a href="#faq">FAQ</a>
            </div>
        </div>
    </header>

    <main>
        {{ $slot }}
    </main>

    <a href="https://wa.me/50689671132" target="_blank" rel="noopener" class="fixed bottom-5 right-5 z-50 flex h-14 w-14 items-center justify-center rounded-full shadow-xl" style="background-color:#25D366;" aria-label="WhatsApp">
        <svg class="size-8 text-white" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.198.297-.768.966-.94 1.164-.173.198-.347.223-.644.075-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.372-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.372-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479s1.065 2.876 1.213 3.074c.148.198 2.095 3.2 5.076 4.487.709.306 1.262.489 1.693.625.711.227 1.358.195 1.87.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.174-1.414-.075-.124-.273-.198-.57-.347m-5.421 7.618h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.375A9.86 9.86 0 012.01 12C2.01 6.486 6.495 2 12.01 2c2.67 0 5.18 1.04 7.067 2.928A9.95 9.95 0 0122 12c-.002 5.514-4.486 10-9.949 10"/>
        </svg>
    </a>
</body>
</html>
