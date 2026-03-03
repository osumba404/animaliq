<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomepageSlide extends Model
{
    protected $fillable = [
        'title', 'subtitle', 'image_path', 'cta_text', 'cta_link',
        'cta_secondary_text', 'cta_secondary_link',
        'display_order', 'status',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
