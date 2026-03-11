<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHomeBannerRequest;
use App\Http\Requests\UpdateHomeBannerRequest;
use App\Models\HomeBanner;
use App\Services\ImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HomeBannerController extends Controller
{
    public function __construct(private readonly ImageUploadService $imageUploadService)
    {
    }

    public function index(): View
    {
        return view('admin.home-banners.index', [
            'banners' => HomeBanner::query()->ordered()->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.home-banners.create');
    }

    public function store(StoreHomeBannerRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = (bool) $request->boolean('is_active', true);
        $data['image'] = $this->imageUploadService->store($request->file('image'), 'home-banners');

        HomeBanner::query()->create($data);

        return redirect()->route('admin.home-banners.index')->with('status', 'Banner creado correctamente.');
    }

    public function edit(HomeBanner $home_banner): View
    {
        return view('admin.home-banners.edit', ['banner' => $home_banner]);
    }

    public function update(UpdateHomeBannerRequest $request, HomeBanner $home_banner): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = (bool) $request->boolean('is_active', false);

        if ($request->hasFile('image')) {
            $this->imageUploadService->delete($home_banner->image);
            $data['image'] = $this->imageUploadService->store($request->file('image'), 'home-banners');
        }

        $home_banner->update($data);

        return redirect()->route('admin.home-banners.index')->with('status', 'Banner actualizado correctamente.');
    }

    public function destroy(HomeBanner $home_banner): RedirectResponse
    {
        $this->imageUploadService->delete($home_banner->image);
        $home_banner->delete();

        return redirect()->route('admin.home-banners.index')->with('status', 'Banner eliminado correctamente.');
    }
}
