<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $formFields = [
        'country', 'state', 'city', 'application_type', 'experience_summary',
        'primary_expertise', 'years_experience', 'current_role', 'organization',
        'education_level', 'academic_field', 'skills', 'relevant_experience',
        'challenge_track', 'challenge_interest_reason', 'has_solution_idea',
        'problem_to_solve', 'affected_people', 'proposed_solution',
        'technology_contribution', 'beneficiaries', 'differentiation', 'idea_stage',
        'has_prototype', 'prototype_link', 'collaborator_type', 'team_matching',
        'team_name', 'team_lead', 'team_size', 'team_description', 'team_members',
        'accessibility_requirements', 'accessibility_support',
        'responsible_participation_confirmed', 'information_accurate', 'privacy_consent',
        'community_opt_in', 'applicant_declaration_agreed',
    ];

    public function up(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->string('country', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('application_type', 100)->nullable();
            $table->text('experience_summary')->nullable();
            $table->string('primary_expertise', 150)->nullable();
            $table->unsignedTinyInteger('years_experience')->nullable();
            $table->string('current_role', 150)->nullable();
            $table->string('organization', 200)->nullable();
            $table->string('education_level', 150)->nullable();
            $table->string('academic_field', 150)->nullable();
            $table->text('skills')->nullable();
            $table->text('relevant_experience')->nullable();
            $table->string('challenge_track', 150)->nullable();
            $table->text('challenge_interest_reason')->nullable();
            $table->boolean('has_solution_idea')->nullable();
            $table->text('problem_to_solve')->nullable();
            $table->text('affected_people')->nullable();
            $table->text('proposed_solution')->nullable();
            $table->text('technology_contribution')->nullable();
            $table->text('beneficiaries')->nullable();
            $table->text('differentiation')->nullable();
            $table->json('idea_stage')->nullable();
            $table->boolean('has_prototype')->nullable();
            $table->string('prototype_link', 2048)->nullable();
            $table->string('collaborator_type', 150)->nullable();
            $table->boolean('team_matching')->nullable();
            $table->string('team_name', 200)->nullable();
            $table->string('team_lead', 200)->nullable();
            $table->unsignedTinyInteger('team_size')->nullable();
            $table->text('team_description')->nullable();
            $table->text('team_members')->nullable();
            $table->boolean('accessibility_requirements')->nullable();
            $table->text('accessibility_support')->nullable();
            $table->boolean('responsible_participation_confirmed')->nullable();
            $table->boolean('information_accurate')->nullable();
            $table->boolean('privacy_consent')->nullable();
            $table->boolean('community_opt_in')->nullable();
            $table->boolean('applicant_declaration_agreed')->nullable();
        });

        DB::table('applications')->select('id', 'responses')->orderBy('id')->chunkById(100, function ($applications) {
            foreach ($applications as $application) {
                $responses = json_decode($application->responses, true) ?: [];
                $data = array_intersect_key($responses, array_flip($this->formFields));

                if (isset($data['idea_stage'])) {
                    $data['idea_stage'] = json_encode($data['idea_stage'], JSON_THROW_ON_ERROR);
                }

                if ($data !== []) {
                    DB::table('applications')->where('id', $application->id)->update($data);
                }
            }
        });

        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn('responses');
        });
    }

    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->json('responses')->nullable();
        });

        DB::table('applications')->select(['id', ...$this->formFields])->orderBy('id')->chunkById(100, function ($applications) {
            foreach ($applications as $application) {
                $responses = [];
                foreach ($this->formFields as $field) {
                    if ($application->{$field} !== null) {
                        $responses[$field] = $field === 'idea_stage'
                            ? json_decode($application->{$field}, true)
                            : $application->{$field};
                    }
                }

                DB::table('applications')->where('id', $application->id)->update([
                    'responses' => json_encode($responses, JSON_THROW_ON_ERROR),
                ]);
            }
        });

        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn($this->formFields);
        });
    }
};