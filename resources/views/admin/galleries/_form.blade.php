@csrf
<div class="space-y-4">
    <div>
        <label class="text-sm font-medium">Titulo</label>
        <input type="text" name="title" class="mt-1 block w-full rounded-md border-gray-300" value="{{ old('title', $gallery->title ?? '') }}">
    </div>

    <div>
        <label class="text-sm font-medium">Categoria</label>
        <select name="category" class="mt-1 block w-full rounded-md border-gray-300" required>
            @foreach($categories as $category)
                <option value="{{ $category }}" @selected(old('category', $gallery->category ?? '') === $category)>{{ ucfirst($category) }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="text-sm font-medium">Imagen</label>
        <input type="file" name="image" class="mt-1 block w-full" accept="image/*" {{ empty($gallery ?? null) ? 'required' : '' }}>
        @if(!empty($gallery?->image))
            <img src="{{ asset('storage/'.$gallery->image) }}" alt="Galeria" class="mt-2 h-24 w-24 rounded object-cover" loading="lazy">
        @endif
        @error('image')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>
</div>
