<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use App\Mail\ContactFormUserMail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'message' => 'required|string|max:2000',
        ]);

        // Письмо админу
        Mail::to(config('mail.from.address'))->send(new ContactFormMail($validated));

        // Письмо пользователю
        Mail::to($validated['email'])->send(new ContactFormUserMail($validated));

        return back()->with('success', 'Ваше сообщение отправлено!');
    }
}
