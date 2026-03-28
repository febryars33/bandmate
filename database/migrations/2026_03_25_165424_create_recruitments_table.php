<?php

use App\Models\User;
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
        Schema::create('recruitments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Regency::class)->nullable();
            $table->string('regency_name')->nullable();

            $table->string('title');
            $table->string('slug')->unique();

            // 🔥 NEW COLUMNS (IMPORTANT)
            $table->string('title_normalized')->nullable()->index();
            $table->string('title_compact')->nullable()->index();

            $table->longText('description')->nullable();
            $table->boolean('is_active')->default(false);
            $table->morphs('recruitmentable'); // Band or Event can create a recruitment
            $table->softDeletes();
            $table->timestamps();

            // FULLTEXT INDEX
            $table->fullText(['title', 'regency_name', 'description']);
        });

        // 🔥 DATA NORMALIZATION (POST CREATE)
        DB::statement("
            UPDATE recruitments
            SET
                title_normalized = LOWER(title),
                title_compact = REPLACE(LOWER(title), ' ', '')
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recruitments');
    }
};
