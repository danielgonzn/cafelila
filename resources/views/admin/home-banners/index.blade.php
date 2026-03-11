<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Banners de Inicio</h2>
            <a href="{{ route('admin.home-banners.create') }}" class="rounded-md bg-[#562B05] px-4 py-2 text-white">Nuevo banner</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 rounded-lg bg-green-100 p-3 text-sm text-green-800">{{ session('status') }}</div>
            @endif

            <div class="overflow-x-auto rounded-xl bg-white shadow">
                <table class="min-w-full text-sm">
                    <thead class="bg-stone-100 text-left">
                        <tr>
                            <th class="p-3">Imagen</th>
                            <th class="p-3">Titulo</th>
                            <th class="p-3">Orden</th>
                            <th class="p-3">Estado</th>
                            <th class="p-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($banners as $banner)
                            <tr class="border-t">
                                <td class="p-3">
                                    @if($banner->image)
                                        <img src="{{ asset('storage/'.$banner->image) }}" alt="{{ $banner->title }}" class="h-16 w-28 rounded object-cover" loading="lazy">
                                    @endif
                                </td>
                                <td class="p-3">{{ $banner->title }}</td>
                                <td class="p-3">{{ $banner->order }}</td>
                                <td class="p-3">{{ $banner->is_active ? 'Activo' : 'Inactivo' }}</td>
                                <td class="p-3">
                                    <div class="flex gap-3 text-sm">
                                        <a href="{{ route('admin.home-banners.edit', $banner) }}" class="text-blue-600">Editar</a>
                                        <form method="POST" action="{{ route('admin.home-banners.destroy', $banner) }}" onsubmit="return confirm('Eliminar banner?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-600">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td class="p-4" colspan="5">No hay banners creados.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $banners->links() }}</div>
        </div>
    </div>
</x-app-layout>
