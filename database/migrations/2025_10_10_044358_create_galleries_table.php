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
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->json('media')->nullable(); 
            $table->string('type')->nullable();
            $table->tinyInteger('month')->unsigned(); // 1-12
            $table->year('year');
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->integer('menu_order')->default(0);
            $table->timestamps();

            // Indexes for filtering
            $table->index(['type', 'year', 'month', 'created_at']);
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
