<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Invoice extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'quotation_id',
        'customer_id',
        'invoice_date',
        'due_date',
        'total_amount',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'invoice_date' => 'date',
        'due_date' => 'date',
    ];

    /**
     * Get the quotation that owns the invoice.
     */
    public function quotation(): BelongsTo
    {
        return $this->belongsTo(Quotation::class);
    }

    /**
     * Get the customer that owns the invoice.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    /**
     * Set the invoice date and automatically calculate the due date.
     */
    public function setInvoiceDateAttribute(string $value): void
    {
        $this->attributes['invoice_date'] = $value;
        if (! $this->attributes['due_date']) {
            $this->attributes['due_date'] = Carbon::parse($value)->addDays(15);
        }
    }
}
