<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    public function index(): View
    {
        return view('admin.contacts.index', [
            'messages' => ContactMessage::query()->latest()->paginate(20),
        ]);
    }

    public function show(ContactMessage $contact): View
    {
        if (! $contact->read_at) {
            $contact->update(['read_at' => now()]);
        }

        return view('admin.contacts.show', [
            'message' => $contact,
        ]);
    }

    public function destroy(ContactMessage $contact): RedirectResponse
    {
        $contact->delete();

        return redirect()->route('admin.contacts.index')->with('status', 'Mensaje eliminado correctamente.');
    }
}
