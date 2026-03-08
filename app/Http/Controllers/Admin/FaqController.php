<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFaqRequest;
use App\Models\Faq;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FaqController extends Controller
{
    public function index(): View
    {
        return view('admin.faqs.index', [
            'faqs' => Faq::query()->orderBy('order')->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.faqs.create');
    }

    public function store(StoreFaqRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['status'] = (bool) $request->boolean('status', true);

        Faq::query()->create($data);

        return redirect()->route('admin.faqs.index')->with('status', 'FAQ creada correctamente.');
    }

    public function edit(Faq $faq): View
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(StoreFaqRequest $request, Faq $faq): RedirectResponse
    {
        $data = $request->validated();
        $data['status'] = (bool) $request->boolean('status', false);

        $faq->update($data);

        return redirect()->route('admin.faqs.index')->with('status', 'FAQ actualizada correctamente.');
    }

    public function destroy(Faq $faq): RedirectResponse
    {
        $faq->delete();

        return redirect()->route('admin.faqs.index')->with('status', 'FAQ eliminada correctamente.');
    }
}
