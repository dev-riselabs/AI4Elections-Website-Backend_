<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommunityMembership extends Model
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
        'organization',
        'areas_of_interest',
        'participation_preference',
        'education_qualification',
        'about_yourself',
        'community_consent',
        'community_consented_at',
        'email_updates',
        'email_updates_consented_at',
    ];

    protected function casts(): array
    {
        return [
            'community_consent' => 'boolean',
            'community_consented_at' => 'datetime',
            'email_updates' => 'boolean',
            'email_updates_consented_at' => 'datetime',
        ];
    }
}
