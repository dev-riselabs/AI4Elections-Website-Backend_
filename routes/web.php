<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;

Route::get('/', function (): JsonResponse {
    return response()->json([
        'message' => 'AI4Elections',
        'data' => [
            'status' => 'ok',
            'app' => config('app.name'),
            'health' => url('/api/health'),
        ],
    ]);
});