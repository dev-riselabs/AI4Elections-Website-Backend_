<?php

namespace App\Services;

use App\Models\CommunityMembership;
use Illuminate\Support\Arr;

class CommunityMembershipService
{
    public function join(array $validatedData): CommunityMembership
    {
        $now = now();
        $emailUpdates = (bool) ($validatedData['email_updates'] ?? false);
        $membershipData = Arr::except($validatedData, ['email_updates']);

        return CommunityMembership::updateOrCreate(
            ['email' => $validatedData['email']],
            [
                ...$membershipData,
                'community_consent' => true,
                'community_consented_at' => $now,
                'email_updates' => $emailUpdates,
                'email_updates_consented_at' => $emailUpdates ? $now : null,
            ],
        );
    }
}
