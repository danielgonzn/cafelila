<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Crear producto</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="rounded-xl bg-white p-6 shadow space-y-5">
                @include('admin.products._form')
                <button class="rounded-md bg-[#562B05] px-5 py-2 text-white">Guardar</button>
            </form>
        </div>
    </div>
</x-app-layout>
