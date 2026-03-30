<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    /**
     * Get the event_organizer that owns the Event
     */
    public function event_organizer(): BelongsTo
    {
        return $this->belongsTo(EventOrganizer::class);
    }
}
