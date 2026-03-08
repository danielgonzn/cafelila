<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Editar FAQ</h2></x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('admin.faqs.update', $faq) }}" class="rounded-xl bg-white p-6 shadow space-y-5">
                @method('PUT')
                @include('admin.faqs._form', ['faq' => $faq])
                <button class="rounded-md bg-[#562B05] px-5 py-2 text-white">Actualizar</button>
            </form>
        </div>
    </div>
</x-app-layout>
