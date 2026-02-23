<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'tier',
        'start_date',
        'end_date',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /**
     * Get the user that owns the subscription.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if the subscription is basic.
     */
    public function isBasic(): bool
    {
        return $this->tier === 'Basic';
    }

    /**
     * Check if the subscription is standard.
     */
    public function isStandard(): bool
    {
        return $this->tier === 'Standard';
    }

    /**
     * Check if the subscription is premium.
     */
    public function isPremium(): bool
    {
        return $this->tier === 'Premium';
    }
}
