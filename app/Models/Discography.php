<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Discography extends Model
{
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'is_single',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'songs' => 'integer',
        ];
    }

    /**
     * Get the truncated about
     */
    protected function isSingle(): Attribute
    {
        return Attribute::make(function () {
            return $this->total_songs == 1;
        });
    }
}
