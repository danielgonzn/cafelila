<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Configuracion del sitio</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 rounded-lg bg-green-100 p-3 text-sm text-green-800">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="rounded-xl bg-white p-6 shadow space-y-5" x-data="{ open: 'inicio' }">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    <section class="rounded-lg border border-stone-200">
                        <button type="button" @click="open = open === 'branding' ? '' : 'branding'" class="w-full px-4 py-3 flex items-center justify-between text-left">
                            <span class="font-semibold text-stone-800">Branding</span>
                            <span class="text-stone-500" x-text="open === 'branding' ? '-' : '+'"></span>
                        </button>
                        <div x-show="open === 'branding'" x-transition class="px-4 pb-4">
                            <div class="grid gap-5 md:grid-cols-2">
                                <div class="md:col-span-2">
                                    <label class="text-sm font-medium">Logo del sitio</label>
                                    <input type="file" name="logo_image" class="mt-1 block w-full" accept="image/*">
                                    @error('logo_image')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                                    @if(!empty($settings['logo_image'] ?? null))
                                        <img src="{{ asset('storage/'.$settings['logo_image']) }}" alt="Logo actual" class="mt-3 h-14 w-auto rounded bg-stone-50 p-1">
                                        <label class="mt-3 inline-flex items-center gap-2 text-sm text-stone-700">
                                            <input type="checkbox" name="remove_logo_image" value="1" @checked(old('remove_logo_image'))>
                                            Eliminar logo actual
                                        </label>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="rounded-lg border border-stone-200">
                        <button type="button" @click="open = open === 'inicio' ? '' : 'inicio'" class="w-full px-4 py-3 flex items-center justify-between text-left">
                            <span class="font-semibold text-stone-800">Inicio</span>
                            <span class="text-stone-500" x-text="open === 'inicio' ? '-' : '+'"></span>
                        </button>
                        <div x-show="open === 'inicio'" x-transition class="px-4 pb-4">
                            <div class="grid gap-5 md:grid-cols-2">
                                <div class="md:col-span-2">
                                    <label class="text-sm font-medium">Banner / Imagen de fondo de Inicio</label>
                                    <input type="file" name="hero_background_image" class="mt-1 block w-full" accept="image/*">
                                    @error('hero_background_image')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                                    @if(!empty($settings['hero_background_image'] ?? null))
                                        <img src="{{ asset('storage/'.$settings['hero_background_image']) }}" alt="Fondo inicio actual" class="mt-3 h-24 w-full max-w-md rounded object-cover">
                                        <label class="mt-3 inline-flex items-center gap-2 text-sm text-stone-700">
                                            <input type="checkbox" name="remove_hero_background_image" value="1" @checked(old('remove_hero_background_image'))>
                                            Eliminar fondo actual de Inicio
                                        </label>
                                    @endif
                                </div>
                                <div class="md:col-span-2">
                                    <label class="text-sm font-medium">Titulo principal</label>
                                    <input type="text" name="hero_title" class="mt-1 block w-full rounded-md border-gray-300" value="{{ old('hero_title', $settings['hero_title'] ?? '') }}" required>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="text-sm font-medium">Descripcion principal</label>
                                    <textarea name="hero_subtitle" rows="2" class="mt-1 block w-full rounded-md border-gray-300" required>{{ old('hero_subtitle', $settings['hero_subtitle'] ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="rounded-lg border border-stone-200">
                        <button type="button" @click="open = open === 'nosotros' ? '' : 'nosotros'" class="w-full px-4 py-3 flex items-center justify-between text-left">
                            <span class="font-semibold text-stone-800">Nosotros</span>
                            <span class="text-stone-500" x-text="open === 'nosotros' ? '-' : '+'"></span>
                        </button>
                        <div x-show="open === 'nosotros'" x-transition class="px-4 pb-4">
                            <div class="grid gap-5 md:grid-cols-2">
                                <div class="md:col-span-2">
                                    <label class="text-sm font-medium">Historia</label>
                                    <textarea name="about_text" rows="4" class="mt-1 block w-full rounded-md border-gray-300" required>{{ old('about_text', $settings['about_text'] ?? '') }}</textarea>
                                </div>
                                <div>
                                    <label class="text-sm font-medium">Mision</label>
                                    <textarea name="mission" rows="3" class="mt-1 block w-full rounded-md border-gray-300" required>{{ old('mission', $settings['mission'] ?? '') }}</textarea>
                                </div>
                                <div>
                                    <label class="text-sm font-medium">Vision</label>
                                    <textarea name="vision" rows="3" class="mt-1 block w-full rounded-md border-gray-300" required>{{ old('vision', $settings['vision'] ?? '') }}</textarea>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="text-sm font-medium">Valores</label>
                                    <textarea name="values" rows="3" class="mt-1 block w-full rounded-md border-gray-300" required>{{ old('values', $settings['values'] ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="rounded-lg border border-stone-200">
                        <button type="button" @click="open = open === 'contacto' ? '' : 'contacto'" class="w-full px-4 py-3 flex items-center justify-between text-left">
                            <span class="font-semibold text-stone-800">Contacto Y Redes</span>
                            <span class="text-stone-500" x-text="open === 'contacto' ? '-' : '+'"></span>
                        </button>
                        <div x-show="open === 'contacto'" x-transition class="px-4 pb-4">
                            <div class="grid gap-5 md:grid-cols-2">
                                <div class="md:col-span-2">
                                    <label class="text-sm font-medium">Direccion</label>
                                    <textarea name="address" rows="2" class="mt-1 block w-full rounded-md border-gray-300" required>{{ old('address', $settings['address'] ?? '') }}</textarea>
                                </div>
                                <div>
                                    <label class="text-sm font-medium">Telefono</label>
                                    <input type="text" name="phone" class="mt-1 block w-full rounded-md border-gray-300" value="{{ old('phone', $settings['phone'] ?? '') }}" required>
                                </div>
                                <div>
                                    <label class="text-sm font-medium">Correo principal</label>
                                    <input type="email" name="email" class="mt-1 block w-full rounded-md border-gray-300" value="{{ old('email', $settings['email'] ?? '') }}" required>
                                </div>
                                <div>
                                    <label class="text-sm font-medium">Correo secundario</label>
                                    <input type="email" name="email_secondary" class="mt-1 block w-full rounded-md border-gray-300" value="{{ old('email_secondary', $settings['email_secondary'] ?? '') }}">
                                </div>
                                <div>
                                    <label class="text-sm font-medium">Instagram</label>
                                    <input type="url" name="instagram" class="mt-1 block w-full rounded-md border-gray-300" value="{{ old('instagram', $settings['instagram'] ?? '') }}">
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="rounded-lg border border-stone-200">
                        <button type="button" @click="open = open === 'ubicacion' ? '' : 'ubicacion'" class="w-full px-4 py-3 flex items-center justify-between text-left">
                            <span class="font-semibold text-stone-800">Ubicacion</span>
                            <span class="text-stone-500" x-text="open === 'ubicacion' ? '-' : '+'"></span>
                        </button>
                        <div x-show="open === 'ubicacion'" x-transition class="px-4 pb-4">
                            <div>
                                <label class="text-sm font-medium">Google Maps Embed URL</label>
                                <input type="url" name="maps_embed_url" class="mt-1 block w-full rounded-md border-gray-300" value="{{ old('maps_embed_url', $settings['maps_embed_url'] ?? '') }}" required>
                            </div>
                        </div>
                    </section>

                    <section class="rounded-lg border border-stone-200">
                        <button type="button" @click="open = open === 'seo' ? '' : 'seo'" class="w-full px-4 py-3 flex items-center justify-between text-left">
                            <span class="font-semibold text-stone-800">SEO</span>
                            <span class="text-stone-500" x-text="open === 'seo' ? '-' : '+'"></span>
                        </button>
                        <div x-show="open === 'seo'" x-transition class="px-4 pb-4">
                            <div class="grid gap-5 md:grid-cols-2">
                                <div>
                                    <label class="text-sm font-medium">Meta title</label>
                                    <input type="text" name="meta_title" class="mt-1 block w-full rounded-md border-gray-300" value="{{ old('meta_title', $settings['meta_title'] ?? '') }}" required>
                                </div>
                                <div>
                                    <label class="text-sm font-medium">Meta description</label>
                                    <input type="text" name="meta_description" class="mt-1 block w-full rounded-md border-gray-300" value="{{ old('meta_description', $settings['meta_description'] ?? '') }}" required>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                <button class="rounded-md bg-[#562B05] px-5 py-2 text-white">Guardar cambios</button>
            </form>
        </div>
    </div>
</x-app-layout>
