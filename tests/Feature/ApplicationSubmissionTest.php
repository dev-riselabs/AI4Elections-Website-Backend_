<?php

namespace Tests\Feature;

use App\Mail\ApplicationReceived;
use App\Models\Application;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ApplicationSubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_applicant_can_submit_a_complete_application(): void
    {
        Mail::fake();

        $response = $this->postJson('/api/applications', $this->validApplication());

        $response
            ->assertCreated()
            ->assertJsonPath('message', 'Application submitted successfully.')
            ->assertJsonPath('data.status', 'submitted');

        $this->assertDatabaseHas('applications', [
            'email' => 'alex@example.com',
            'first_name' => 'Alex',
            'status' => 'submitted',
        ]);

        $this->assertSame('Public policy', Application::first()->responses['academic_field']);

        Mail::assertQueued(ApplicationReceived::class, function (ApplicationReceived $mail): bool {
            return $mail->hasTo('alex@example.com')
                && $mail->application->id === Application::first()->id
                && str_contains($mail->render(), 'Hello Alex,')
                && str_contains($mail->render(), (string) $mail->application->id);
        });
    }

    public function test_submission_requires_the_privacy_and_declaration_confirmations(): void
    {
        Mail::fake();
        $payload = $this->validApplication();
        unset($payload['privacy_consent'], $payload['applicant_declaration_agreed']);

        $this->postJson('/api/applications', $payload)
            ->assertUnprocessable()
            ->assertJsonValidationErrors([
                'privacy_consent',
                'applicant_declaration_agreed',
            ]);

        $this->assertDatabaseCount('applications', 0);
        Mail::assertNothingOutgoing();
    }

    private function validApplication(): array
    {
        return [
            'first_name' => 'Alex',
            'last_name' => 'Rivera',
            'email' => 'alex@example.com',
            'phone' => '+1 555 0100',
            'country' => 'United States',
            'state' => 'California',
            'city' => 'Oakland',
            'application_type' => 'Individual',
            'experience_summary' => 'I work on civic technology.',
            'primary_expertise' => 'Data science',
            'years_experience' => 4,
            'current_role' => 'Researcher',
            'organization' => 'Civic Lab',
            'education_level' => 'Masters',
            'academic_field' => 'Public policy',
            'skills' => 'Research, data analysis',
            'relevant_experience' => 'Built public-interest data tools.',
            'challenge_track' => 'Electoral integrity',
            'challenge_interest_reason' => 'I want to support trustworthy elections.',
            'has_solution_idea' => true,
            'problem_to_solve' => 'Voters need reliable information.',
            'affected_people' => 'First-time voters',
            'proposed_solution' => 'A verified information resource.',
            'technology_contribution' => 'AI-assisted content review.',
            'beneficiaries' => 'Voters and civic groups',
            'differentiation' => 'Designed around transparent sources.',
            'idea_stage' => ['Early concept'],
            'has_prototype' => false,
            'prototype_link' => null,
            'collaborator_type' => 'Product designer',
            'team_matching' => true,
            'team_name' => null,
            'team_lead' => null,
            'team_size' => null,
            'team_description' => null,
            'team_members' => null,
            'accessibility_requirements' => false,
            'accessibility_support' => null,
            'responsible_participation_confirmed' => true,
            'information_accurate' => true,
            'privacy_consent' => true,
            'community_opt_in' => false,
            'applicant_declaration_agreed' => true,
        ];
    }
}
