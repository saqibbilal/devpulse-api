<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\Api\ContactController;


Route::apiResource('projects', ProjectController::class)->only(['index', 'show']);

Route::get('/skills', [SkillController::class, 'index']);

// Throttle to 3 messages per minute per IP to prevent spam
Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:3,1');
