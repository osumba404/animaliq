<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = [
        'name',
        'image',
        'role',
        'remarks',
        'role_description',
        'socials',
        'display_order',
    ];

    protected function casts(): array
    {
        return [
            'socials' => 'array',
        ];
    }
}
