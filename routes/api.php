<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LeadController;
use App\Http\Controllers\AuthController;

Route::post('/auth', [AuthController::class, 'login']);
Route::middleware(['auth:api'])->group(function () {
    Route::post('/lead', [LeadController::class, 'store']);
    Route::get('/lead/{id}', [LeadController::class, 'show']);
    Route::get('/leads', [LeadController::class, 'index']);
});