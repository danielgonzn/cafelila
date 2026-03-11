<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard CafeLila</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <div class="rounded-xl bg-white p-5 shadow">Productos: <strong>{{ $productCount }}</strong></div>
            <div class="rounded-xl bg-white p-5 shadow">Productos activos: <strong>{{ $activeProductCount }}</strong></div>
            <div class="rounded-xl bg-white p-5 shadow">Banners inicio: <strong>{{ $bannerCount }}</strong></div>
            <div class="rounded-xl bg-white p-5 shadow">FAQs: <strong>{{ $faqCount }}</strong></div>
            <div class="rounded-xl bg-white p-5 shadow">Imagenes en galeria: <strong>{{ $galleryCount }}</strong></div>
            <div class="rounded-xl bg-white p-5 shadow">Mensajes de contacto: <strong>{{ $contactCount }}</strong></div>
            <div class="rounded-xl bg-white p-5 shadow">Mensajes sin leer: <strong>{{ $unreadContactCount }}</strong></div>
        </div>
    </div>
</x-app-layout>
