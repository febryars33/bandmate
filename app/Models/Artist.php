<?php

namespace App\Models;

use Database\Factories\ArtistFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Artist extends Model
{
    /** @use HasFactory<ArtistFactory> */
    use HasFactory;

    protected $with = [
        'spotify',
        'few_genres',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_verified' => 'boolean',
        ];
    }

    /**
     * Get the spotify associated with the Artist
     */
    public function spotify(): HasOne
    {
        return $this->hasOne(SpotifyArtist::class);
    }

    /**
     * The genres that belong to the Artist
     */
    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    /**
     * The few_genres that belong to the Artist
     */
    public function few_genres(): BelongsToMany
    {
        return $this->genres()->limit(5);
    }
}
