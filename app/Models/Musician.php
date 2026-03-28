<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Musician extends Model
{
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
     * Get the user associated with the Musician
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
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
