<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
// Added for Activity Logging
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Organisation extends Model
{
    use HasFactory, LogsActivity; // <-- Trait Added

    protected $fillable = [
        'name',
        'email',
        'phone',
        'website',
        // Add other fields as necessary
    ];

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }
    
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    // Activity Log Configuration
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable() 
            ->logOnlyDirty() 
            ->dontSubmitEmptyLogs(); 
    }
}