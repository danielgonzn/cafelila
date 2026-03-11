<x-layouts.frontend :settings="$settings">
    @php
        $heroBackgroundImage = !empty($settings['hero_background_image'] ?? null)
            ? asset('storage/'.$settings['hero_background_image'])
            : 'https://thumbs.dreamstime.com/b/cup-coffee-some-beans-creative-ai-design-background-instagram-facebook-wall-painting-backgrounds-photo-wallpaper-art-325051633.jpg';
    @endphp

    @if($banners->isNotEmpty())
        <section id="inicio" class="relative overflow-hidden" x-data="{ i: 0, total: {{ $banners->count() }} }" x-init="setInterval(() => i = (i + 1) % total, 6000)">
            <div class="relative min-h-[540px] md:min-h-[680px]">
                @foreach($banners as $index => $banner)
                    @php
                        $bannerImage = !empty($banner->image) ? asset('storage/'.$banner->image) : $heroBackgroundImage;
                    @endphp
                    <article
                        x-show="i === {{ $index }}"
                        x-transition:enter="transition-opacity ease-out duration-700"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition-opacity ease-in duration-500"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="absolute inset-0"
                    >
                        <div class="absolute inset-0" style="background-image: url('{{ $bannerImage }}'); background-size: cover; background-position: center; background-repeat: no-repeat;"></div>
                        <div class="absolute inset-0 bg-black/45"></div>

                        <div class="container-shell relative z-10 flex h-full items-center py-16 md:py-24">
                            <div>
                                <p class="mb-3 text-xs uppercase tracking-[0.25em] text-[#f1ddcb]">Premium Coffee Brand</p>
                                <h1 class="max-w-3xl text-4xl font-extrabold leading-tight text-white md:text-6xl">{{ $banner->title }}</h1>
                                @if($banner->subtitle)
                                    <p class="mt-6 max-w-2xl text-base text-stone-100 md:text-lg">{{ $banner->subtitle }}</p>
                                @endif
                                @if($banner->cta_text && $banner->cta_url)
                                    <a href="{{ $banner->cta_url }}" class="btn-primary mt-8">{{ $banner->cta_text }}</a>
                                @endif
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="pointer-events-none absolute inset-x-0 bottom-5 z-20 flex justify-center gap-2">
                @foreach($banners as $index => $banner)
                    <button
                        type="button"
                        class="pointer-events-auto h-2.5 w-2.5 rounded-full bg-white/60 transition"
                        :class="i === {{ $index }} ? 'bg-white scale-110' : 'bg-white/50'"
                        @click="i = {{ $index }}"
                        aria-label="Ir al banner {{ $index + 1 }}"
                    ></button>
                @endforeach
            </div>

            <button type="button" class="absolute left-4 top-1/2 z-20 -translate-y-1/2 rounded-full bg-black/30 px-3 py-2 text-white" @click="i = (i - 1 + total) % total" aria-label="Banner anterior">&larr;</button>
            <button type="button" class="absolute right-4 top-1/2 z-20 -translate-y-1/2 rounded-full bg-black/30 px-3 py-2 text-white" @click="i = (i + 1) % total" aria-label="Banner siguiente">&rarr;</button>
        </section>
    @else
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
    @endif

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

    <section id="productos" class="py-16 md:py-24 bg-stone-50" x-data="{ showProductModal: false, selectedProduct: null, openProduct(product) { this.selectedProduct = product; this.showProductModal = true; }, closeProduct() { this.showProductModal = false; }, goToContact() { this.closeProduct(); window.location.hash = 'contacto'; } }" @keydown.escape.window="closeProduct()">
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
                            <button
                                type="button"
                                class="mt-4 inline-flex w-full items-center justify-center rounded-lg border border-[#562B05] px-3 py-2 text-sm font-semibold text-[#562B05] transition hover:bg-[#562B05] hover:text-white"
                                data-name="{{ $product->name }}"
                                data-roast-type="{{ $product->roast_type }}"
                                data-weight="{{ $product->weight }}"
                                data-category="{{ $product->category }}"
                                data-description="{{ $product->description }}"
                                data-image="{{ $product->image ? asset('storage/'.$product->image) : '' }}"
                                @click="openProduct({
                                    name: $el.dataset.name,
                                    roast_type: $el.dataset.roastType,
                                    weight: $el.dataset.weight,
                                    category: $el.dataset.category,
                                    description: $el.dataset.description,
                                    image: $el.dataset.image || null,
                                })"
                            >
                                Ver ficha tecnica
                            </button>
                        </div>
                    </article>
                @endforeach
            </div>

            <div x-show="showProductModal" x-transition.opacity class="fixed inset-0 z-[70] flex items-center justify-center p-4 md:p-6" style="display: none;" @click.self="closeProduct()">
                <div class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
                <article class="relative z-10 w-full max-w-4xl overflow-hidden rounded-3xl border border-[#c28c5e]/25 bg-[#fffdf8] shadow-[0_30px_70px_rgba(0,0,0,0.35)]" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
                    <div class="grid md:grid-cols-[1.05fr_1fr]">
                        <div class="relative min-h-[280px] md:min-h-[560px]">
                            <template x-if="selectedProduct && selectedProduct.image">
                                <img :src="selectedProduct.image" alt="Producto" class="absolute inset-0 h-full w-full object-cover">
                            </template>
                            <template x-if="!selectedProduct || !selectedProduct.image">
                                <div class="absolute inset-0 ornament"></div>
                            </template>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                <p class="text-[11px] uppercase tracking-[0.2em] text-[#f1ddcb]">Ficha tecnica</p>
                                <h3 class="mt-2 text-2xl font-extrabold leading-tight" x-text="selectedProduct ? selectedProduct.name : ''"></h3>
                            </div>
                        </div>

                        <div class="relative flex flex-col">
                            <button type="button" class="absolute right-4 top-4 rounded-full border border-stone-300/70 bg-white/80 p-2 text-stone-600 transition hover:bg-white hover:text-stone-900" @click="closeProduct()" aria-label="Cerrar ficha">✕</button>

                            <div class="px-6 pb-6 pt-14 md:px-8 md:pt-16">
                                <p class="text-xs uppercase tracking-[0.22em] text-[#8f5c35]">CafeLila Gourmet</p>
                                <p class="mt-3 text-sm leading-relaxed text-stone-600" x-text="selectedProduct && selectedProduct.description ? selectedProduct.description : 'Producto gourmet de origen costarricense, ideal para preparaciones de alta calidad.'"></p>

                                <div class="mt-6 flex flex-wrap gap-2 text-xs">
                                    <span class="rounded-full border border-[#c28c5e]/45 bg-[#fdf3e6] px-3 py-1.5 font-semibold text-[#6a3e1f]">
                                        Tueste: <span class="font-medium" x-text="selectedProduct && selectedProduct.roast_type ? selectedProduct.roast_type : 'No especificado'"></span>
                                    </span>
                                    <span class="rounded-full border border-[#c28c5e]/45 bg-[#fdf3e6] px-3 py-1.5 font-semibold text-[#6a3e1f]">
                                        Presentacion: <span class="font-medium" x-text="selectedProduct && selectedProduct.weight ? selectedProduct.weight : 'No especificada'"></span>
                                    </span>
                                    <span class="rounded-full border border-[#c28c5e]/45 bg-[#fdf3e6] px-3 py-1.5 font-semibold text-[#6a3e1f]">
                                        Categoria: <span class="font-medium" x-text="selectedProduct && selectedProduct.category ? selectedProduct.category : 'No especificada'"></span>
                                    </span>
                                </div>

                                <div class="mt-8 rounded-2xl border border-stone-200/80 bg-white p-4">
                                    <p class="text-sm font-semibold text-stone-800">Recomendacion de uso</p>
                                    <p class="mt-2 text-sm text-stone-600">Ideal para cafeterias, retail y aliados comerciales que buscan consistencia en aroma, cuerpo y perfil de sabor.</p>
                                </div>
                            </div>

                            <div class="mt-auto border-t border-stone-200/80 bg-white/70 px-6 py-4 md:px-8">
                                <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                                    <button type="button" class="inline-flex items-center justify-center rounded-lg border border-[#562B05] px-4 py-2 text-sm font-semibold text-[#562B05] transition hover:bg-[#562B05] hover:text-white" @click="goToContact()">Solicitar cotizacion</button>
                                    <button type="button" class="inline-flex items-center justify-center rounded-lg bg-[#2f1a0d] px-4 py-2 text-sm font-semibold text-white transition hover:bg-black" @click="closeProduct()">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
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
        <div class="container-shell max-w-3xl">
            <div class="mb-8 text-center">
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
