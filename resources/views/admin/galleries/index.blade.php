<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Galeria</h2>
            <a href="{{ route('admin.galleries.create') }}" class="rounded-md bg-[#562B05] px-4 py-2 text-white">Nueva imagen</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 rounded-lg bg-green-100 p-3 text-sm text-green-800">{{ session('status') }}</div>
            @endif
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @forelse($galleries as $gallery)
                    <article class="rounded-xl bg-white p-4 shadow">
                        <img src="{{ asset('storage/'.$gallery->image) }}" alt="{{ $gallery->title }}" class="h-44 w-full rounded-md object-cover" loading="lazy">
                        <p class="mt-3 font-semibold">{{ $gallery->title ?: 'Sin titulo' }}</p>
                        <p class="text-sm text-gray-500">{{ ucfirst($gallery->category) }}</p>
                        <div class="mt-3 flex gap-3 text-sm">
                            <a href="{{ route('admin.galleries.edit', $gallery) }}" class="text-blue-600">Editar</a>
                            <form method="POST" action="{{ route('admin.galleries.destroy', $gallery) }}" onsubmit="return confirm('Eliminar imagen?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600">Eliminar</button>
                            </form>
                        </div>
                    </article>
                @empty
                    <p>No hay imagenes cargadas.</p>
                @endforelse
            </div>
            <div class="mt-4">{{ $galleries->links() }}</div>
        </div>
    </div>
</x-app-layout>
