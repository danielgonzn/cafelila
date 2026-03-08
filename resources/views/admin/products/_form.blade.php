@csrf
<div class="grid gap-5 md:grid-cols-2">
    <div class="md:col-span-2">
        <label class="text-sm font-medium">Nombre</label>
        <input type="text" name="name" class="mt-1 block w-full rounded-md border-gray-300" value="{{ old('name', $product->name ?? '') }}" required>
        @error('name')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="text-sm font-medium">Slug</label>
        <input type="text" name="slug" class="mt-1 block w-full rounded-md border-gray-300" value="{{ old('slug', $product->slug ?? '') }}">
        @error('slug')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="text-sm font-medium">Categoria</label>
        <input type="text" name="category" class="mt-1 block w-full rounded-md border-gray-300" value="{{ old('category', $product->category ?? 'gourmet') }}" required>
    </div>

    <div>
        <label class="text-sm font-medium">Peso</label>
        <input type="text" name="weight" class="mt-1 block w-full rounded-md border-gray-300" value="{{ old('weight', $product->weight ?? '') }}" required>
        @error('weight')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="text-sm font-medium">Tipo de tueste</label>
        <input type="text" name="roast_type" class="mt-1 block w-full rounded-md border-gray-300" value="{{ old('roast_type', $product->roast_type ?? '') }}" required>
        @error('roast_type')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>

    <div class="md:col-span-2">
        <label class="text-sm font-medium">Descripcion</label>
        <textarea name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300">{{ old('description', $product->description ?? '') }}</textarea>
    </div>

    <div>
        <label class="text-sm font-medium">Imagen</label>
        <input type="file" name="image" class="mt-1 block w-full" accept="image/*">
        @if(!empty($product?->image))
            <img src="{{ asset('storage/'.$product->image) }}" alt="Producto" class="mt-2 h-24 w-24 rounded object-cover" loading="lazy">
        @endif
    </div>

    <div class="flex items-center gap-2">
        <input type="checkbox" name="status" value="1" @checked(old('status', $product->status ?? true))>
        <span class="text-sm">Activo</span>
    </div>
</div>
