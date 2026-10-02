<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:40'],
            'country' => ['required', 'string', 'max:100'],
            'state' => ['required', 'string', 'max:100'],
            'city' => ['required', 'string', 'max:100'],
            'application_type' => ['required', 'string', 'max:100'],
            'experience_summary' => ['required', 'string', 'max:5000'],
            'primary_expertise' => ['required', 'string', 'max:150'],
            'years_experience' => ['required', 'integer', 'min:0', 'max:80'],
            'current_role' => ['required', 'string', 'max:150'],
            'organization' => ['required', 'string', 'max:200'],
            'education_level' => ['required', 'string', 'max:150'],
            'academic_field' => ['required', 'string', 'max:150'],
            'skills' => ['required', 'string', 'max:3000'],
            'relevant_experience' => ['required', 'string', 'max:5000'],
            'challenge_track' => ['required', 'string', 'max:150'],
            'challenge_interest_reason' => ['required', 'string', 'max:5000'],
            'has_solution_idea' => ['required', 'boolean'],
            'problem_to_solve' => ['required', 'string', 'max:5000'],
            'affected_people' => ['required', 'string', 'max:3000'],
            'proposed_solution' => ['required', 'string', 'max:5000'],
            'technology_contribution' => ['required', 'string', 'max:5000'],
            'beneficiaries' => ['required', 'string', 'max:3000'],
            'differentiation' => ['required', 'string', 'max:3000'],
            'idea_stage' => ['required', 'array', 'min:1'],
            'idea_stage.*' => ['required', 'string', 'max:100'],
            'has_prototype' => ['nullable', 'boolean'],
            'prototype_link' => ['nullable', 'url', 'max:2048'],
            'collaborator_type' => ['nullable', 'string', 'max:150'],
            'team_matching' => ['nullable', 'boolean'],
            'team_name' => ['nullable', 'string', 'max:200'],
            'team_lead' => ['nullable', 'string', 'max:200'],
            'team_size' => ['nullable', 'integer', 'min:1', 'max:100'],
            'team_description' => ['nullable', 'string', 'max:5000'],
            'team_members' => ['nullable', 'string', 'max:5000'],
            'accessibility_requirements' => ['nullable', 'boolean'],
            'accessibility_support' => ['nullable', 'string', 'max:5000'],
            'responsible_participation_confirmed' => ['accepted'],
            'information_accurate' => ['accepted'],
            'privacy_consent' => ['accepted'],
            'community_opt_in' => ['nullable', 'boolean'],
            'applicant_declaration_agreed' => ['accepted'],
        ];
    }
}
