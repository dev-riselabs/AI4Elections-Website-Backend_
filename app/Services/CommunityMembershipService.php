<?php

namespace App\Services;

use App\Mail\CommunityMembershipReceived;
use App\Models\CommunityMembership;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;

class CommunityMembershipService
{
    public function join(array $validatedData): CommunityMembership
    {
        $now = now();
        $emailUpdates = (bool) ($validatedData['email_updates'] ?? false);
        $membershipData = Arr::except($validatedData, ['email_updates']);

        $membership = CommunityMembership::updateOrCreate(
            ['email' => $validatedData['email']],
            [
                ...$membershipData,
                'community_consent' => true,
                'community_consented_at' => $now,
                'email_updates' => $emailUpdates,
                'email_updates_consented_at' => $emailUpdates ? $now : null,
            ],
        );

        Mail::to($membership->email)->queue(new CommunityMembershipReceived($membership));

        return $membership;
    }
}
