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
        'responses',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'responses' => 'array',
        ];
    }
}
