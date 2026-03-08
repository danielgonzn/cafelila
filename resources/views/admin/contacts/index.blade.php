<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Mensajes de contacto</h2>
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
                            <th class="p-3">Estado</th>
                            <th class="p-3">Nombre</th>
                            <th class="p-3">Correo</th>
                            <th class="p-3">Telefono</th>
                            <th class="p-3">Fecha</th>
                            <th class="p-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($messages as $message)
                            <tr class="border-t">
                                <td class="p-3">
                                    @if($message->read_at)
                                        <span class="rounded-full bg-green-100 px-2 py-1 text-xs text-green-700">Leido</span>
                                    @else
                                        <span class="rounded-full bg-amber-100 px-2 py-1 text-xs text-amber-700">Nuevo</span>
                                    @endif
                                </td>
                                <td class="p-3">{{ $message->name }}</td>
                                <td class="p-3">{{ $message->email }}</td>
                                <td class="p-3">{{ $message->phone ?: 'N/A' }}</td>
                                <td class="p-3">{{ $message->created_at->format('d/m/Y H:i') }}</td>
                                <td class="p-3">
                                    <div class="flex gap-3 text-sm">
                                        <a href="{{ route('admin.contacts.show', $message) }}" class="text-blue-600">Ver</a>
                                        <form method="POST" action="{{ route('admin.contacts.destroy', $message) }}" onsubmit="return confirm('Eliminar mensaje?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-600">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td class="p-4" colspan="6">No hay mensajes de contacto.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $messages->links() }}</div>
        </div>
    </div>
</x-app-layout>
