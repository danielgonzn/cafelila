<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSiteSettingsRequest;
use App\Models\SiteSetting;
use App\Services\ImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SiteSettingController extends Controller
{
    public function __construct(private readonly ImageUploadService $imageUploadService)
    {
    }

    public function edit(): View
    {
        $settings = SiteSetting::query()->pluck('value', 'key');

        return view('admin.settings.edit', compact('settings'));
    }

    public function update(UpdateSiteSettingsRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $oldLogo = SiteSetting::getValue('logo_image');
        $oldHeroBackground = SiteSetting::getValue('hero_background_image');

        if ($request->hasFile('logo_image')) {
            $validated['logo_image'] = $this->imageUploadService->store($request->file('logo_image'), 'branding');
            $this->imageUploadService->delete($oldLogo);
        } elseif (! empty($validated['remove_logo_image'])) {
            $this->imageUploadService->delete($oldLogo);
            $validated['logo_image'] = '';
        }

        if ($request->hasFile('hero_background_image')) {
            $validated['hero_background_image'] = $this->imageUploadService->store($request->file('hero_background_image'), 'branding/hero');
            $this->imageUploadService->delete($oldHeroBackground);
        } elseif (! empty($validated['remove_hero_background_image'])) {
            $this->imageUploadService->delete($oldHeroBackground);
            $validated['hero_background_image'] = '';
        }

        unset($validated['remove_logo_image']);
        unset($validated['remove_hero_background_image']);

        foreach ($validated as $key => $value) {
            SiteSetting::query()->updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return redirect()->route('admin.settings.edit')->with('status', 'Configuracion actualizada correctamente.');
    }
}
