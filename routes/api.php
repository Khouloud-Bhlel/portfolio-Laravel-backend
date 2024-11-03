<?php
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MediaController;

 Route::apiResource('projects', ProjectController::class);
Route::post('projects', [ProjectController::class, 'store']);
Route::post('messages', [MessageController::class, 'store']);
Route::post('/upload/Portfolio', [MediaController::class, 'upload']);
