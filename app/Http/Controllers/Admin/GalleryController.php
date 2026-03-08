<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use App\Models\Gallery;
use App\Services\ImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function __construct(private readonly ImageUploadService $imageUploadService)
    {
    }

    public function index(): View
    {
        return view('admin.galleries.index', [
            'galleries' => Gallery::query()->latest()->paginate(18),
            'categories' => Gallery::categories(),
        ]);
    }

    public function create(): View
    {
        return view('admin.galleries.create', [
            'categories' => Gallery::categories(),
        ]);
    }

    public function store(StoreGalleryRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['image'] = $this->imageUploadService->store($request->file('image'), 'gallery');

        Gallery::query()->create($data);

        return redirect()->route('admin.galleries.index')->with('status', 'Imagen agregada correctamente.');
    }

    public function edit(Gallery $gallery): View
    {
        return view('admin.galleries.edit', [
            'gallery' => $gallery,
            'categories' => Gallery::categories(),
        ]);
    }

    public function update(UpdateGalleryRequest $request, Gallery $gallery): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $this->imageUploadService->delete($gallery->image);
            $data['image'] = $this->imageUploadService->store($request->file('image'), 'gallery');
        }

        $gallery->update($data);

        return redirect()->route('admin.galleries.index')->with('status', 'Imagen actualizada correctamente.');
    }

    public function destroy(Gallery $gallery): RedirectResponse
    {
        $this->imageUploadService->delete($gallery->image);
        $gallery->delete();

        return redirect()->route('admin.galleries.index')->with('status', 'Imagen eliminada correctamente.');
    }
}
