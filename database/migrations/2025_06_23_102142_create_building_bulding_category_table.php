<?php

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
        Schema::create('building_bulding_category', function (Blueprint $table) {
            $table->foreignId('building_id')->constrained('buildings')->cascadeOnDelete();
            $table->foreignId('bulding_category_id')->constrained('bulding_categories')->cascadeOnDelete();
            $table->primary(['building_id', 'bulding_category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('building_bulding_category');
    }
};
