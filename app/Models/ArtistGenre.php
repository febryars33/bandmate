<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArtistGenre extends Model
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'artist_id',
    ];

    /**
     * Get the artist that owns the ArtistGenre
     */
    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class);
    }
}
