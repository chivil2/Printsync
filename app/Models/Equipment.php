<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Equipment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'type',
        'serial_number',
        'description',
        'purchase_date',
        'status',
        'stock',
        'reorder_level',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'purchase_date' => 'date',
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::updated(function (Equipment $equipment) {
            if ($equipment->stock < $equipment->reorder_level) {
                Log::warning("Inventory Alert: {$equipment->name} (Serial: {$equipment->serial_number}) is below reorder level. Stock: {$equipment->stock}, Reorder Level: {$equipment->reorder_level}");
                // Here you would typically send a notification (email, Slack, etc.)
            }
        });
    }
}
