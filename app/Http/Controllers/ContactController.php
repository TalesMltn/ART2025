<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage; // ← ¡IMPORTANTE!

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'message' => 'required|string|min:10|max:1000',
        ]);

        ContactMessage::create([ // ← AHORA EXISTE
            'name'    => $request->name,
            'email'   => $request->email,
            'message' => $request->message,
        ]);

        return back()
            ->with('success', '¡Mensaje enviado con éxito! Te responderemos pronto.')
            ->withInput();
    }
}