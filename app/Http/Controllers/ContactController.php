<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactReceived;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'message' => 'required|string|min:10',
        ]);

        // Store in DB
        $contact = Contact::create([
            ...$validated,
            'ip_address' => $request->ip(),
        ]);

        // Send Email (We will create the Mailable next)
        Mail::to(config('mail.from.address'))->send(new ContactReceived($contact));

        return response()->json([
            'status'  => 'success',
            'message' => 'Message received! I will get back to you soon.'
        ]);
    }
}
