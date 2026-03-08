<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Models\ContactMessage;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(StoreContactRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        ContactMessage::query()->create($validated);

        $emails = array_filter([
            SiteSetting::getValue('email', 'lila.roastery@gmail.com'),
            SiteSetting::getValue('email_secondary', 'oficinalila@gmail.com'),
        ]);

        $body = "Nuevo contacto desde CafeLila\n\n"
            ."Nombre: {$validated['name']}\n"
            ."Empresa: ".($validated['company'] ?? 'N/A')."\n"
            ."Correo: {$validated['email']}\n"
            ."Telefono: ".($validated['phone'] ?? 'N/A')."\n\n"
            ."Mensaje:\n{$validated['message']}\n";

        try {
            Mail::raw($body, function ($message) use ($emails, $validated): void {
                $message->to($emails)
                    ->subject('Nuevo formulario de contacto - CafeLila')
                    ->replyTo($validated['email'], $validated['name']);
            });
        } catch (\Throwable $exception) {
            Log::warning('No se pudo enviar correo de contacto', [
                'error' => $exception->getMessage(),
                'email' => $validated['email'],
            ]);
        }

        return redirect()->to(route('home').'#contacto')->with('status', 'Tu mensaje fue enviado correctamente.');
    }
}
