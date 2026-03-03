<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Mail\ContactMessage;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(StoreContactRequest $request)
    {
        // The code only reaches this point if validation passed!

        // 1. Get ONLY the validated data
        $validated = $request->validated();

        // 2. Persist to DB
        $contact = Contact::create([
            'name'       => $validated['name'],
            'email'      => $validated['email'],
            'body'       => $validated['message'], // Mapping 'message' to 'body'
            'ip_address' => $request->ip(),
        ]);

        // 3. Send the Email
        Mail::to('saqib_bilal786@yahoo.com')->send(new ContactMessage($contact));

        return response()->json([
            'status'  => 'success',
            'message' => 'I will get back to you soon.'
        ]);
    }
}
