<?php

use Illuminate\Support\Facades\Route;
use App\Models\Contact;
use App\Mail\ContactReceived;

Route::get('/mail-preview', function () {
    $contact = Contact::latest()->first() ?? new Contact([
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'message' => 'I would love to discuss a new Laravel/Next.js project with you!'
    ]);

    return new ContactReceived($contact);
});

Route::get('/', function () {
    return response()->json([
        'status' => 'online',
        'framework' => 'Laravel 12',
        'environment' => app()->environment()
    ]);
});
