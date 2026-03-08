<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">FAQ</h2>
            <a href="{{ route('admin.faqs.create') }}" class="rounded-md bg-[#562B05] px-4 py-2 text-white">Nueva FAQ</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 rounded-lg bg-green-100 p-3 text-sm text-green-800">{{ session('status') }}</div>
            @endif
            <div class="overflow-x-auto rounded-xl bg-white shadow">
                <table class="min-w-full text-sm">
                    <thead class="bg-stone-100 text-left">
                        <tr>
                            <th class="p-3">Orden</th>
                            <th class="p-3">Pregunta</th>
                            <th class="p-3">Estado</th>
                            <th class="p-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($faqs as $faq)
                            <tr class="border-t">
                                <td class="p-3">{{ $faq->order }}</td>
                                <td class="p-3">{{ $faq->question }}</td>
                                <td class="p-3">{{ $faq->status ? 'Activa' : 'Inactiva' }}</td>
                                <td class="p-3">
                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.faqs.edit', $faq) }}" class="text-blue-600">Editar</a>
                                        <form method="POST" action="{{ route('admin.faqs.destroy', $faq) }}" onsubmit="return confirm('Eliminar FAQ?')">
                                            @csrf @method('DELETE')
                                            <button class="text-red-600">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td class="p-4" colspan="4">No hay FAQs registradas.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $faqs->links() }}</div>
        </div>
    </div>
</x-app-layout>
