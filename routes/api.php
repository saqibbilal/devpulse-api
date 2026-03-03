<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\RateLimiter;


Route::apiResource('projects', ProjectController::class)->only(['index', 'show']);

Route::get('/skills', [SkillController::class, 'index']);

// Throttle to 3 messages per minute per IP to prevent spam
Route::middleware(['throttle:3,1'])->post('/contact', [ContactController::class, 'send']);
