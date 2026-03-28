<?php

namespace App\Models;

use Database\Factories\ArtistFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Snairbef\Regional\Models\Regency;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Artist extends Model
{
    /** @use HasFactory<ArtistFactory> */
    use HasFactory, SoftDeletes, HasSlug;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'truncated_about',
    ];

    protected $with = [
        'spotify',
        'few_genres',
    ];

    protected static function booted()
    {
        static::saving(function ($artist) {
            $name = strtolower($artist->name);

            $artist->name_normalized = $name;
            $artist->name_compact = preg_replace('/[^a-z0-9]/', '', $name);
        });
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

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
     * Get the truncated about
     */
    protected function truncatedAbout(): Attribute
    {
        return Attribute::make(function() {
            return Str::limit(
                strip_tags($this->about),
                160,
                '...'
            );
        });
    }

    /**
     * Get the regency that owns the Artist
     */
    public function regency(): BelongsTo
    {
        return $this->belongsTo(Regency::class);
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
     * Get all of the discographies for the Artist
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function discographies(): HasMany
    {
        return $this->hasMany(Discography::class);
    }

    /**
     * Get all of the complete_lineups for the Artist
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function complete_lineups(): HasMany
    {
        return $this->hasMany(ArtistMusician::class)
            ->with('musician')
            ->orderBy('joined_at', 'asc');
    }

    /**
     * Get all of the current_lineups for the Artist
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function current_lineups(): HasMany
    {
        return $this->hasMany(ArtistMusician::class)
            ->where('left_at', null)
            ->with('musician')
            ->orderBy('joined_at', 'asc');
    }

    /**
     * Get all of the past_members for the Artist
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function past_members(): HasMany
    {
        return $this->hasMany(ArtistMusician::class)
            ->where('left_at', '!=', null)
            ->with('musician')
            ->orderBy('left_at', 'asc');
    }

    /**
     * The current_lineups that belong to the Artist
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    // public function current_lineups(): BelongsToMany
    // {
    //     return $this->belongsToMany(Musician::class)
    //         ->using(ArtistMusician::class)
    //         ->orderByPivot('joined_at', 'desc')
    //         ->withPivot('joined_at', 'instruments')
    //         ->wherePivot('left_at', null);
    // }

    /**
     * The past_members that belong to the Artist
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    // public function past_members(): BelongsToMany
    // {
    //     return $this->belongsToMany(Musician::class)
    //         ->using(ArtistMusician::class)
    //         ->orderByPivot('left_at', 'desc')
    //         ->withPivot('joined_at', 'left_at', 'instruments')
    //         ->wherePivot('left_at', '!=', null);
    // }

    /**
     * The few_genres that belong to the Artist
     */
    public function few_genres(): BelongsToMany
    {
        return $this->genres()->limit(3);
    }

    /**
     * Get all of the recruitments for the Artist
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function recruitments(): MorphMany
    {
        return $this->morphMany(Recruitment::class, 'recruitmentable');
    }
}
