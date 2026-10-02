<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationRequest;
use App\Services\ApplicationService;
use Illuminate\Http\JsonResponse;

class ApplicationController extends Controller
{
    public function store(
        StoreApplicationRequest $request,
        ApplicationService $applicationService,
    ): JsonResponse {
        $application = $applicationService->submit($request->validated());

        return response()->json([
            'message' => 'Application submitted successfully.',
            'data' => [
                'id' => $application->id,
                'status' => $application->status,
                'submitted_at' => $application->created_at->toIso8601String(),
            ],
        ], 201);
    }
}
