<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table(app(config('curator.model'))->getTable(), function (Blueprint $table) {
            $table->longText('exif')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table(app(config('curator.model'))->getTable(), function (Blueprint $table) {
            $table->text('exif')->nullable()->change();
        });
    }
};
