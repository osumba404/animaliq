<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DepartmentMember extends Model
{
    protected $fillable = ['department_id', 'user_id', 'position_title', 'is_lead', 'display_order'];

    protected function casts(): array
    {
        return ['is_lead' => 'boolean'];
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
