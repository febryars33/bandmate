<?php

use App\Enums\Gender;
use App\Models\Genre;
use App\Models\Instrument;
use App\Models\Musician;
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
        Schema::create('musicians', function (Blueprint $table) {
            $table->id();
            $table->string('stage_name')->nullable();
            $table->string('real_name')->nullable();
            $table->longText('bio')->nullable();
            $table->longText('about')->nullable();
            $table->json('social_links')->nullable();
            $table->enum('gender', Gender::cases())->nullable();
            $table->string('birth_place')->nullable();
            $table->timestamps();
        });

        Schema::create('instrument_musician', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Musician::class);
            $table->foreignIdFor(Instrument::class);
            $table->longText('description')->nullable();
            $table->json('instrument_details')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->fullText(['description']);
        });

        Schema::create('genre_musician', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Musician::class);
            $table->foreignIdFor(Genre::class);
            $table->longText('description')->nullable();
            $table->json('genre_details')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->fullText(['description']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('musicians');
    }
};
