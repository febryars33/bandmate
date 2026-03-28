<?php

use App\Models\Artist;
use App\Models\Genre;
use App\Models\Musician;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Snairbef\Regional\Models\Regency;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('artists', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Regency::class)->nullable();
            $table->string('regency_name')->nullable();
            $table->string('spotify_artist_id')->unique()->nullable();

            $table->string('name');
            $table->string('slug')->unique();

            // 🔥 NEW COLUMNS (IMPORTANT)
            $table->string('name_normalized')->nullable()->index();
            $table->string('name_compact')->nullable()->index();

            $table->longText('about')->nullable();

            $table->string('img_logo')->nullable();
            $table->string('img_cover')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->timestamp('spotify_synced_at')->nullable();
            $table->softDeletes();
            $table->timestamps();

            // FULLTEXT INDEX
            $table->fullText(['name', 'regency_name', 'about']);
        });

        Schema::create('artist_genre', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Artist::class);
            $table->foreignIdFor(Genre::class);
            $table->timestamps();
        });

        Schema::create('artist_musician', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Artist::class);
            $table->foreignIdFor(Musician::class)->nullable();
            $table->string('name');
            $table->timestamp('joined_at')->nullable();
            $table->timestamp('left_at')->nullable();
            $table->json('instruments')->nullable();
            $table->timestamps();
        });

        // 🔥 DATA NORMALIZATION (POST CREATE)
        DB::statement("
            UPDATE artists
            SET
                name_normalized = LOWER(name),
                name_compact = REPLACE(LOWER(name), ' ', '')
        ");
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

/**
 * Database Trigger
 */
// CREATE TRIGGER trg_artists_normalize
// BEFORE INSERT ON artists
// FOR EACH ROW
// SET
//     NEW.name_normalized = LOWER(NEW.name),
//     NEW.name_compact = REPLACE(LOWER(NEW.name), ' ', '');
