<x-layouts.frontend :settings="$settings">
    @php
        $heroBackgroundImage = !empty($settings['hero_background_image'] ?? null)
            ? asset('storage/'.$settings['hero_background_image'])
            : 'https://thumbs.dreamstime.com/b/cup-coffee-some-beans-creative-ai-design-background-instagram-facebook-wall-painting-backgrounds-photo-wallpaper-art-325051633.jpg';
    @endphp

    <section id="inicio" class="relative overflow-hidden py-20 md:py-28" style="background-image: url('{{ $heroBackgroundImage }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div class="absolute inset-0 bg-white/70"></div>
        <div class="absolute -right-20 top-10 h-64 w-64 rounded-full bg-[#562B05]/10 blur-3xl"></div>
        <div class="container-shell relative grid items-center gap-12 md:grid-cols-2">
            <div>
                <p class="mb-3 text-xs uppercase tracking-[0.25em] text-[#562B05]">Premium Coffee Brand</p>
                <h1 class="text-4xl font-extrabold leading-tight md:text-6xl">{{ $settings['hero_title'] ?? 'Tecnologia Industrial para el Procesamiento de Cafe' }}</h1>
                <p class="mt-6 max-w-xl text-base text-stone-700 md:text-lg">{{ $settings['hero_subtitle'] ?? 'Importacion de cafe de alta gama y materia prima para potenciar tu produccion.' }}</p>
                <a href="#productos" class="btn-primary mt-8">Ver catalogo</a>
            </div>
            <div class="card-surface p-4">
                @if($products->first()?->image)
                    <img src="{{ asset('storage/'.$products->first()->image) }}" alt="CafeLila" class="h-[430px] w-full rounded-xl object-cover" loading="lazy">
                @else
                    <div class="h-[430px] w-full rounded-xl ornament flex items-center justify-center">
                        <p class="text-xl font-semibold text-[#562B05]">CafeLila Gourmet</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section id="nosotros" class="py-16 md:py-24">
        <div class="container-shell grid gap-8 md:grid-cols-2">
            <div>
                <h2 class="section-title">Nosotros</h2>
                <h3 class="mt-4 text-lg font-semibold text-[#562B05]">Historia</h3>
                <p class="mt-5 leading-relaxed text-stone-700">{{ $settings['about_text'] ?? 'Cafe Lila nace de la necesidad de brindar un producto de alta calidad al mercado costarricense con un cafe gourmet que pueda llegar al mercado nacional por medio de socios comerciales.' }}</p>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                <article class="card-surface p-5">
                    <h3 class="font-bold text-[#562B05]">Mision</h3>
                    <p class="mt-2 text-sm text-stone-700">{{ $settings['mission'] ?? '' }}</p>
                </article>
                <article class="card-surface p-5">
                    <h3 class="font-bold text-[#562B05]">Vision</h3>
                    <p class="mt-2 text-sm text-stone-700">{{ $settings['vision'] ?? '' }}</p>
                </article>
                <article class="card-surface p-5 sm:col-span-2">
                    <h3 class="font-bold text-[#562B05]">Valores</h3>
                    <p class="mt-2 text-sm text-stone-700">{{ $settings['values'] ?? '' }}</p>
                </article>
            </div>
        </div>
    </section>

    <section id="productos" class="py-16 md:py-24 bg-stone-50">
        <div class="container-shell">
            <h2 class="section-title">Productos</h2>
            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach($products as $product)
                    <article class="card-surface overflow-hidden">
                        @if($product->image)
                            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="h-52 w-full object-cover" loading="lazy">
                        @else
                            <div class="h-52 w-full ornament"></div>
                        @endif
                        <div class="p-5">
                            <h3 class="font-bold text-sm leading-5">{{ $product->name }}</h3>
                            <p class="mt-3 text-sm text-stone-600">{{ $product->roast_type }}</p>
                            <p class="text-sm text-stone-600">{{ $product->weight }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-16">
        <div class="container-shell">
            <h2 class="section-title">Galeria</h2>
            <div class="mt-8 grid grid-cols-2 gap-4 md:grid-cols-3">
                @forelse($gallery as $item)
                    <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title ?? 'CafeLila galeria' }}" class="h-44 md:h-56 w-full rounded-xl object-cover" loading="lazy">
                @empty
                    <p class="text-stone-600">Agrega imagenes desde el panel administrador.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section id="ubicacion" class="py-16 bg-stone-900 text-white">
        <div class="container-shell grid gap-8 md:grid-cols-2">
            <div>
                <h2 class="section-title text-white">Ubicacion</h2>
                <p class="mt-5 leading-relaxed text-stone-200">{{ $settings['address'] ?? 'Costa Rica, Puntarenas, Coto Brus, Sabalito, Barrio Mercedes, Contiguo a Mayoreo BM' }}</p>
            </div>
            <div class="overflow-hidden rounded-2xl border border-white/15">
                <iframe src="{{ $settings['maps_embed_url'] ?? 'https://www.google.com/maps?q=Coto+Brus+Sabalito+Barrio+Mercedes&output=embed' }}" width="100%" height="320" style="border:0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

    <section id="contacto" class="py-16 md:py-24">
        <div class="container-shell grid gap-8 md:grid-cols-2">
            <div>
                <h2 class="section-title">Contacto</h2>
                <p class="mt-4 text-stone-700">Escribenos para cotizaciones, muestras o alianzas comerciales.</p>
                @if (session('status'))
                    <div class="mt-4 rounded-lg bg-green-100 p-3 text-sm text-green-800">{{ session('status') }}</div>
                @endif
            </div>
            <form action="{{ route('contact.store') }}" method="POST" class="card-surface p-6 space-y-4">
                @csrf
                <div>
                    <label class="text-sm font-medium">Nombre</label>
                    <input type="text" name="name" class="mt-1 w-full rounded-lg border-stone-300" value="{{ old('name') }}" required>
                    @error('name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="text-sm font-medium">Empresa</label>
                    <input type="text" name="company" class="mt-1 w-full rounded-lg border-stone-300" value="{{ old('company') }}">
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="text-sm font-medium">Correo</label>
                        <input type="email" name="email" class="mt-1 w-full rounded-lg border-stone-300" value="{{ old('email') }}" required>
                        @error('email') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="text-sm font-medium">Telefono</label>
                        <input type="text" name="phone" class="mt-1 w-full rounded-lg border-stone-300" value="{{ old('phone') }}">
                    </div>
                </div>
                <div>
                    <label class="text-sm font-medium">Mensaje</label>
                    <textarea name="message" rows="4" class="mt-1 w-full rounded-lg border-stone-300" required>{{ old('message') }}</textarea>
                    @error('message') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <button class="btn-primary">Enviar mensaje</button>
            </form>
        </div>
    </section>

    <section id="faq" class="py-16 bg-stone-50">
        <div class="container-shell max-w-4xl">
            <h2 class="section-title">Preguntas frecuentes</h2>
            <div class="mt-8 space-y-3">
                @foreach($faqs as $faq)
                    <article x-data="{open:false}" class="card-surface p-4">
                        <button @click="open=!open" class="w-full text-left flex items-center justify-between gap-4">
                            <span class="font-semibold">{{ $faq->question }}</span>
                            <span class="text-[#562B05]" x-text="open ? '-' : '+'"></span>
                        </button>
                        <p x-show="open" x-transition class="mt-3 text-sm text-stone-700">{{ $faq->answer }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <footer class="bg-black text-white py-12">
        <div class="container-shell grid gap-8 md:grid-cols-3">
            <div>
                <p class="text-xl font-bold text-[#c28c5e]">CafeLila</p>
                <p class="mt-3 text-sm text-stone-300">Cafe gourmet premium de Costa Rica.</p>
            </div>
            <div>
                <p class="font-semibold">Contacto</p>
                <p class="mt-2 text-sm text-stone-300">{{ $settings['phone'] ?? '+506 8967 1132' }}</p>
                <p class="text-sm text-stone-300">{{ $settings['address'] ?? '' }}</p>
            </div>
            <div>
                <p class="font-semibold">Redes</p>
                <a class="mt-2 inline-block text-sm text-[#c28c5e] hover:underline" href="{{ $settings['instagram'] ?? 'https://www.instagram.com/cafelila.cr' }}" target="_blank" rel="noopener">Instagram</a>
            </div>
        </div>
        <div class="container-shell mt-8 border-t border-white/10 pt-6 text-xs text-stone-400">
            &copy; {{ date('Y') }} CafeLila. Todos los derechos reservados.
        </div>
    </footer>
</x-layouts.frontend>
