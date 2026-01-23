<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SkillController;


Route::apiResource('projects', ProjectController::class)->only(['index', 'show']);

Route::get('/skills', [SkillController::class, 'index']);
