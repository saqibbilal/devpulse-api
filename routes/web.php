<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'status' => 'online',
        'framework' => 'Laravel 12 (Headless API)',
        'environment' => app()->environment()
    ]);
});
