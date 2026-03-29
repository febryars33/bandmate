<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ArtistMusician extends Pivot
{
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'joined_at' => 'datetime',
            'left_at' => 'datetime',
            'instruments' => 'array',
        ];
    }

    /**
     * Get the artist that owns the ArtistMusician
     */
    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class);
    }

    /**
     * Get the musician that owns the ArtistMusician
     */
    public function musician(): BelongsTo
    {
        return $this->belongsTo(Musician::class);
    }
}
