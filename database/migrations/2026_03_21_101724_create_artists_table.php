<?php

use App\Models\Artist;
use App\Models\Genre;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('artists', function (Blueprint $table) {
            $table->id();
            $table->string('spotify_artist_id')->unique()->nullable();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('about')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->timestamp('spotify_synced_at')->nullable();
            $table->timestamps();

            $table->fullText(['name', 'about']);
        });

        Schema::create('artist_genre', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Artist::class);
            $table->foreignIdFor(Genre::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artists');
        Schema::dropIfExists('artist_genre');
    }
};
