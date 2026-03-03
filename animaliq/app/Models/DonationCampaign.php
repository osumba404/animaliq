<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class DonationCampaign extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'description', 'target_amount', 'start_date', 'end_date',
    ];

    protected function casts(): array
    {
        return [
            'target_amount' => 'decimal:2',
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }

    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class, 'campaign_id');
    }
}
