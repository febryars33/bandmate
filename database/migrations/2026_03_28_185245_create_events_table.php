<?php

use App\Models\EventOrganizer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Snairbef\Regional\Models\District;
use Snairbef\Regional\Models\Regency;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(EventOrganizer::class);
            $table->foreignIdFor(Regency::class);
            $table->string('regency_name')->nullable();
            $table->foreignIdFor(District::class);
            $table->string('district_name')->nullable();
            $table->string('name');
            $table->string('slug')->unique();
            $table->longText('description')->nullable();
            $table->timestamps();

            $table->fullText(['regency_name', 'district_name', 'name', 'description']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
