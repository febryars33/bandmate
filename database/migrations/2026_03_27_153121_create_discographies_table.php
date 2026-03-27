<?php

use App\Models\Artist;
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
        Schema::create('discographies', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Artist::class);
            $table->string('title');
            $table->date('release_date');
            $table->json('labels')->nullable();
            $table->string('slug')->unique();
            $table->string('cover')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discographies');
    }
};
