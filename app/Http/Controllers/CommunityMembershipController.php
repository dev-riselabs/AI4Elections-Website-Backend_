<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommunityMembershipRequest;
use App\Services\CommunityMembershipService;
use Illuminate\Http\JsonResponse;

class CommunityMembershipController extends Controller
{
    public function store(
        StoreCommunityMembershipRequest $request,
        CommunityMembershipService $membershipService,
    ): JsonResponse {
        $membership = $membershipService->join($request->validated());
        $created = $membership->wasRecentlyCreated;

        return response()->json([
            'message' => $created
                ? 'Community membership created successfully.'
                : 'Community membership updated successfully.',
            'data' => [
                'id' => $membership->id,
                'email_updates' => $membership->email_updates,
                'community_consented_at' => $membership->community_consented_at->toIso8601String(),
            ],
        ], $created ? 201 : 200);
    }
}
