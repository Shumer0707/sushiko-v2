<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->boolean('is_active')->default(true)->index();
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->timestamps();
        });

        Schema::create('brand_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained('brands')->cascadeOnDelete();
            $table->string('language', 2); // ru, ro, en
            $table->string('name');
            $table->string('slug')->nullable(); // SEO
            $table->timestamps();

            $table->unique(['brand_id', 'language']); // 1 запись на язык
            $table->unique(['language', 'slug']);     // уникальный slug в языке
            $table->index('slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('brand_translations');
        Schema::dropIfExists('brands');
    }
};
