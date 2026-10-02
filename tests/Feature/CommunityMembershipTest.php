<?php

namespace Tests\Feature;

use App\Models\CommunityMembership;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommunityMembershipTest extends TestCase
{
    use RefreshDatabase;

    public function test_person_can_join_the_community_with_required_consent(): void
    {
        $response = $this->postJson('/api/community-memberships', $this->validMembership());

        $response
            ->assertCreated()
            ->assertJsonPath('message', 'Community membership created successfully.')
            ->assertJsonPath('data.email_updates', true);

        $membership = CommunityMembership::firstOrFail();

        $this->assertSame('alex@example.com', $membership->email);
        $this->assertTrue($membership->community_consent);
        $this->assertNotNull($membership->community_consented_at);
        $this->assertTrue($membership->email_updates);
        $this->assertNotNull($membership->email_updates_consented_at);
    }

    public function test_resubmitting_updates_the_existing_membership_and_revokes_email_updates(): void
    {
        $this->postJson('/api/community-memberships', $this->validMembership())
            ->assertCreated();

        $payload = $this->validMembership();
        $payload['first_name'] = 'Alexandra';
        $payload['email_updates'] = false;

        $this->postJson('/api/community-memberships', $payload)
            ->assertOk()
            ->assertJsonPath('data.email_updates', false);

        $this->assertDatabaseCount('community_memberships', 1);
        $membership = CommunityMembership::firstOrFail();
        $this->assertSame('Alexandra', $membership->first_name);
        $this->assertFalse($membership->email_updates);
        $this->assertNull($membership->email_updates_consented_at);
    }

    public function test_community_membership_requires_explicit_community_consent(): void
    {
        $payload = $this->validMembership();
        $payload['community_consent'] = false;

        $this->postJson('/api/community-memberships', $payload)
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['community_consent']);

        $this->assertDatabaseCount('community_memberships', 0);
    }

    private function validMembership(): array
    {
        return [
            'first_name' => 'Alex',
            'last_name' => 'Rivera',
            'email' => ' Alex@Example.com ',
            'phone' => '+1 555 0100',
            'country' => 'United States',
            'state' => 'California',
            'city' => 'Oakland',
            'application_type' => 'Individual',
            'organization' => 'Civic Lab',
            'areas_of_interest' => 'Research',
            'participation_preference' => 'Mentorship',
            'education_qualification' => 'Masters',
            'about_yourself' => 'I work on civic technology.',
            'community_consent' => true,
            'email_updates' => true,
        ];
    }
}
