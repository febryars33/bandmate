<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class InstrumentMusician extends Pivot
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'musician_id',
        'instrument_id',
        'description',
        'instrument_details',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'instrument_details' => 'array',
        ];
    }
}
