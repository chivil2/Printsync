<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RepairJob extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'service_request_id',
        'equipment_id',
        'technician_id',
        'start_date',
        'end_date',
        'status',
        'description',
        'parts_needed',
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
     * Get the service request that owns the repair job.
     */
    public function serviceRequest(): BelongsTo
    {
        return $this->belongsTo(ServiceRequest::class);
    }

    /**
     * Get the equipment for the repair job.
     */
    public function equipment(): BelongsTo
    {
        return $this->belongsTo(Equipment::class);
    }

    /**
     * Get the technician assigned to the repair job.
     */
    public function technician(): BelongsTo
    {
        return $this->belongsTo(User::class, 'technician_id');
    }

    /**
     * Placeholder method for assigning a technician.
     */
    public function assignTechnician(int $technicianId): void
    {
        // In a real application, you would add logic here to validate the technician
        // and potentially apply rules for assignment (e.g., availability, skill matching).
        $this->technician_id = $technicianId;
        $this->save();
        // You might also dispatch an event here, e.g., TechnicianAssigned::dispatch($this);
    }
}
