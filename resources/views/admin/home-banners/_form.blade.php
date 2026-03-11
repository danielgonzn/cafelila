@csrf
<div class="grid gap-5 md:grid-cols-2">
    <div class="md:col-span-2">
        <label class="text-sm font-medium">Titulo</label>
        <input type="text" name="title" class="mt-1 block w-full rounded-md border-gray-300" value="{{ old('title', $banner->title ?? '') }}" required>
        @error('title')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>

    <div class="md:col-span-2">
        <label class="text-sm font-medium">Subtitulo</label>
        <textarea name="subtitle" rows="3" class="mt-1 block w-full rounded-md border-gray-300">{{ old('subtitle', $banner->subtitle ?? '') }}</textarea>
        @error('subtitle')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="text-sm font-medium">Texto CTA</label>
        <input type="text" name="cta_text" class="mt-1 block w-full rounded-md border-gray-300" value="{{ old('cta_text', $banner->cta_text ?? 'Ver catalogo') }}">
    </div>

    <div>
        <label class="text-sm font-medium">URL CTA</label>
        <input type="url" name="cta_url" class="mt-1 block w-full rounded-md border-gray-300" value="{{ old('cta_url', $banner->cta_url ?? '#productos') }}">
        @error('cta_url')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="text-sm font-medium">Orden</label>
        <input type="number" name="order" min="0" class="mt-1 block w-full rounded-md border-gray-300" value="{{ old('order', $banner->order ?? 0) }}">
    </div>

    <div class="flex items-center gap-2 mt-7">
        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $banner->is_active ?? true))>
        <span class="text-sm">Activo</span>
    </div>

    <div class="md:col-span-2">
        <label class="text-sm font-medium">Imagen</label>
        <input type="file" name="image" class="mt-1 block w-full" accept="image/*" {{ empty($banner ?? null) ? 'required' : '' }}>
        @error('image')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror

        @if(!empty($banner?->image))
            <img src="{{ asset('storage/'.$banner->image) }}" alt="Banner" class="mt-3 h-28 w-full max-w-xl rounded object-cover" loading="lazy">
        @endif
    </div>
</div>
