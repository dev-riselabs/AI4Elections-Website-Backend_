<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreCommunityMembershipRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        if ($this->has('email')) {
            $this->merge([
                'email' => Str::lower(trim((string) $this->input('email'))),
            ]);
        }
    }

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
            'application_type' => ['required', 'string', 'max:120'],
            'organization' => ['required', 'string', 'max:200'],
            'areas_of_interest' => ['required', 'string', 'max:200'],
            'participation_preference' => ['required', 'string', 'max:200'],
            'education_qualification' => ['required', 'string', 'max:150'],
            'about_yourself' => ['required', 'string', 'max:5000'],
            'community_consent' => ['accepted'],
            'email_updates' => ['sometimes', 'boolean'],
        ];
    }
}
