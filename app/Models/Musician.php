<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;

class Musician extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'stage_name',
        'real_name',
        'bio',
        'social_links',
        'gender',
        'birth_place',
    ];

    protected $with = [
        'few_instruments',
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
            'bio' => PurifyHtmlOnGet::class,
            'about' => PurifyHtmlOnGet::class,
            'social_links' => 'json',
        ];
    }

    /**
     * Get the user associated with the Musician
     */
    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'musicianable');
    }

    /**
     * The instruments that belong to the Musician
     */
    public function instruments(): BelongsToMany
    {
        return $this->belongsToMany(Instrument::class)
            ->using(InstrumentMusician::class);
    }

    /**
     * The genres that belong to the Musician
     */
    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class)
            ->using(GenreMusician::class);
    }

    public function few_instruments(): BelongsToMany
    {
        return $this->instruments()->limit(3);
    }

    public function few_genres(): BelongsToMany
    {
        return $this->genres()->limit(3);
    }
}
