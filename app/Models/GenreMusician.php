<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class GenreMusician extends Pivot
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'musician_id',
        'genre_id',
        'description',
        'genre_details',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'genre_details' => 'array',
        ];
    }
}
