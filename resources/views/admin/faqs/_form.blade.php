@csrf
<div class="space-y-4">
    <div>
        <label class="text-sm font-medium">Pregunta</label>
        <input type="text" name="question" class="mt-1 block w-full rounded-md border-gray-300" value="{{ old('question', $faq->question ?? '') }}" required>
        @error('question')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="text-sm font-medium">Respuesta</label>
        <textarea name="answer" rows="4" class="mt-1 block w-full rounded-md border-gray-300" required>{{ old('answer', $faq->answer ?? '') }}</textarea>
        @error('answer')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>
    <div class="grid gap-4 sm:grid-cols-2">
        <div>
            <label class="text-sm font-medium">Orden</label>
            <input type="number" name="order" min="0" class="mt-1 block w-full rounded-md border-gray-300" value="{{ old('order', $faq->order ?? 0) }}">
        </div>
        <div class="flex items-center gap-2 mt-7">
            <input type="checkbox" name="status" value="1" @checked(old('status', $faq->status ?? true))>
            <span class="text-sm">Activa</span>
        </div>
    </div>
</div>
