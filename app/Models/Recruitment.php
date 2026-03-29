<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Recruitment extends Model
{
    use HasSlug, SoftDeletes;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'truncated_description',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /**
     * Get the truncated description
     */
    protected function truncatedDescription(): Attribute
    {
        return Attribute::make(function () {
            return Str::limit(
                strip_tags($this->description),
                160,
                '...'
            );
        });
    }

    /**
     * Get the user that owns the Recruitment
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the recruitmentable that owns the Recruitment
     */
    public function recruitmentable(): MorphTo
    {
        return $this->morphTo();
    }
}
