<?php
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\MessageController;

Route::apiResource('projects', ProjectController::class);
Route::post('messages', [MessageController::class, 'store']);
