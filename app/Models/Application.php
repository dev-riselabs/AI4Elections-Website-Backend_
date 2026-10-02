<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'country',
        'state',
        'city',
        'application_type',
        'experience_summary',
        'primary_expertise',
        'years_experience',
        'current_role',
        'organization',
        'education_level',
        'academic_field',
        'skills',
        'relevant_experience',
        'challenge_track',
        'challenge_interest_reason',
        'has_solution_idea',
        'problem_to_solve',
        'affected_people',
        'proposed_solution',
        'technology_contribution',
        'beneficiaries',
        'differentiation',
        'idea_stage',
        'has_prototype',
        'prototype_link',
        'collaborator_type',
        'team_matching',
        'team_name',
        'team_lead',
        'team_size',
        'team_description',
        'team_members',
        'accessibility_requirements',
        'accessibility_support',
        'responsible_participation_confirmed',
        'information_accurate',
        'privacy_consent',
        'community_opt_in',
        'applicant_declaration_agreed',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'idea_stage' => 'array',
            'has_solution_idea' => 'boolean',
            'has_prototype' => 'boolean',
            'team_matching' => 'boolean',
            'accessibility_requirements' => 'boolean',
            'responsible_participation_confirmed' => 'boolean',
            'information_accurate' => 'boolean',
            'privacy_consent' => 'boolean',
            'community_opt_in' => 'boolean',
            'applicant_declaration_agreed' => 'boolean',
        ];
    }
}
