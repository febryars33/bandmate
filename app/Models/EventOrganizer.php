<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EventOrganizer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'about',
        'bio',
    ];

    /**
     * Get all of the events for the EventOrganizer
     */
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
