<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => trim(strip_tags((string) $this->name)),
            'description' => trim(strip_tags((string) $this->description)),
            'weight' => trim(strip_tags((string) $this->weight)),
            'roast_type' => trim(strip_tags((string) $this->roast_type)),
            'category' => trim(strip_tags((string) $this->category)),
            'slug' => $this->slug ? Str::slug((string) $this->slug) : Str::slug((string) $this->name),
        ]);
    }

    public function rules(): array
    {
        /** @var Product $product */
        $product = $this->route('product');

        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('products', 'slug')->ignore($product->id)],
            'description' => ['nullable', 'string'],
            'weight' => ['required', 'string', 'max:50'],
            'roast_type' => ['required', 'string', 'max:50'],
            'category' => ['required', 'string', 'max:80'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'status' => ['nullable', 'boolean'],
        ];
    }
}
