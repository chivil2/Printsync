<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Quotation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'service_request_id',
        'customer_id',
        'quote_date',
        'expiration_date',
        'total_amount',
        'status',
        'convert_to_invoice_flag',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'quote_date' => 'date',
        'expiration_date' => 'date',
        'convert_to_invoice_flag' => 'boolean',
    ];

    /**
     * Get the service request that owns the quotation.
     */
    public function serviceRequest(): BelongsTo
    {
        return $this->belongsTo(ServiceRequest::class);
    }

    /**
     * Get the customer that owns the quotation.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    /**
     * Set the quote date and automatically calculate the expiration date.
     */
    public function setQuoteDateAttribute(string $value): void
    {
        $this->attributes['quote_date'] = $value;
        if (! $this->attributes['expiration_date']) {
            $this->attributes['expiration_date'] = Carbon::parse($value)->addDays(30);
        }
    }
}
