<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SocialAccount extends Model
{
    protected $fillable = [
        'provider',
        'provider_id',
        'token',
        'refresh_token',
        'token_expires_at',
    ];

    protected $casts = [
        'token_expires_at' => 'datetime',
    ];

    protected $hidden = ['token', 'refresh_token'];

    /**
     * Get the user that owns the SocialAccount
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
