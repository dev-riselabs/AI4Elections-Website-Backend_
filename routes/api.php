<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CommunityMembershipController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/status', function () {
    return response()->json([
        'status' => 'online',
        'name' => 'AI4Elections Backend API',
        'framework' => 'Laravel '.app()->version(),
        'timestamp' => now()->toIso8601String(),
    ]);
});

Route::post('/applications', [ApplicationController::class, 'store'])
    ->middleware('throttle:10,1');

Route::post('/community-memberships', [CommunityMembershipController::class, 'store'])
    ->middleware('throttle:10,1');
