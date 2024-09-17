<?php

use Illuminate\Http\Request;

Route::post('/auth', [AuthController::class, 'login']);
Route::middleware(['auth:api'])->group(function () {
    Route::post('/lead', [LeadController::class, 'store']);
    Route::get('/lead/{id}', [LeadController::class, 'show']);
    Route::get('/leads', [LeadController::class, 'index']);
});