<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Productos</h2>
            <a href="{{ route('admin.products.create') }}" class="rounded-md bg-[#562B05] px-4 py-2 text-white">Nuevo</a>
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
                            <th class="p-3">Nombre</th>
                            <th class="p-3">Tueste</th>
                            <th class="p-3">Peso</th>
                            <th class="p-3">Estado</th>
                            <th class="p-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr class="border-t">
                                <td class="p-3">
                                    @if($product->image)
                                        <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="h-14 w-14 rounded object-cover" loading="lazy">
                                    @endif
                                </td>
                                <td class="p-3">{{ $product->name }}</td>
                                <td class="p-3">{{ $product->roast_type }}</td>
                                <td class="p-3">{{ $product->weight }}</td>
                                <td class="p-3">{{ $product->status ? 'Activo' : 'Inactivo' }}</td>
                                <td class="p-3">
                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-600">Editar</a>
                                        <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Eliminar producto?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-600">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td class="p-4" colspan="6">No hay productos registrados.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $products->links() }}</div>
        </div>
    </div>
</x-app-layout>
