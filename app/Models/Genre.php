<?php

namespace App\Models;

use Database\Factories\GenreFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Genre extends Model
{
    /** @use HasFactory<GenreFactory> */
    use HasFactory, SoftDeletes;
}
