<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSiteSettingsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $fields = [
            'hero_title',
            'hero_subtitle',
            'about_text',
            'mission',
            'vision',
            'values',
            'address',
            'phone',
            'email',
            'email_secondary',
            'instagram',
            'meta_title',
            'meta_description',
            'maps_embed_url',
        ];

        $sanitized = [];

        foreach ($fields as $field) {
            $sanitized[$field] = trim(strip_tags((string) $this->input($field)));
        }

        $sanitized['remove_logo_image'] = $this->boolean('remove_logo_image');
        $sanitized['remove_hero_background_image'] = $this->boolean('remove_hero_background_image');

        $this->merge($sanitized);
    }

    public function rules(): array
    {
        return [
            'hero_title' => ['required', 'string', 'max:255'],
            'hero_subtitle' => ['required', 'string', 'max:500'],
            'about_text' => ['required', 'string'],
            'mission' => ['required', 'string'],
            'vision' => ['required', 'string'],
            'values' => ['required', 'string'],
            'address' => ['required', 'string'],
            'phone' => ['required', 'string', 'max:40'],
            'email' => ['required', 'email', 'max:255'],
            'email_secondary' => ['nullable', 'email', 'max:255'],
            'instagram' => ['nullable', 'url', 'max:255'],
            'meta_title' => ['required', 'string', 'max:255'],
            'meta_description' => ['required', 'string', 'max:500'],
            'maps_embed_url' => ['required', 'url', 'max:500'],
            'logo_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:4096'],
            'remove_logo_image' => ['nullable', 'boolean'],
            'hero_background_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:6144'],
            'remove_hero_background_image' => ['nullable', 'boolean'],
        ];
    }
}
