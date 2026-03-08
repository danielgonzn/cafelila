<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detalle del mensaje</h2>
            <a href="{{ route('admin.contacts.index') }}" class="text-sm text-[#562B05]">Volver</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="rounded-xl bg-white p-6 shadow space-y-5">
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <p class="text-xs uppercase text-gray-500">Nombre</p>
                        <p class="font-medium">{{ $message->name }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase text-gray-500">Empresa</p>
                        <p class="font-medium">{{ $message->company ?: 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase text-gray-500">Correo</p>
                        <p class="font-medium">{{ $message->email }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase text-gray-500">Telefono</p>
                        <p class="font-medium">{{ $message->phone ?: 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase text-gray-500">Fecha</p>
                        <p class="font-medium">{{ $message->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase text-gray-500">Estado</p>
                        <p class="font-medium">{{ $message->read_at ? 'Leido' : 'Nuevo' }}</p>
                    </div>
                </div>

                <div>
                    <p class="text-xs uppercase text-gray-500">Mensaje</p>
                    <p class="mt-2 whitespace-pre-line rounded-lg bg-stone-50 p-4 text-sm leading-relaxed">{{ $message->message }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
