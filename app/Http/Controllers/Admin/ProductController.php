<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Services\ImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __construct(private readonly ImageUploadService $imageUploadService)
    {
    }

    public function index(): View
    {
        return view('admin.products.index', [
            'products' => Product::query()->latest()->paginate(12),
        ]);
    }

    public function create(): View
    {
        return view('admin.products.create');
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['status'] = (bool) $request->boolean('status', true);

        if ($request->hasFile('image')) {
            $data['image'] = $this->imageUploadService->store($request->file('image'), 'products');
        }

        Product::query()->create($data);

        return redirect()->route('admin.products.index')->with('status', 'Producto creado correctamente.');
    }

    public function edit(Product $product): View
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $data = $request->validated();
        $data['status'] = (bool) $request->boolean('status', false);

        if ($request->hasFile('image')) {
            $this->imageUploadService->delete($product->image);
            $data['image'] = $this->imageUploadService->store($request->file('image'), 'products');
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('status', 'Producto actualizado correctamente.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $this->imageUploadService->delete($product->image);
        $product->delete();

        return redirect()->route('admin.products.index')->with('status', 'Producto eliminado correctamente.');
    }
}
