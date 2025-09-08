<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true)->index();   // 🔹 фильтры
            $table->unsignedInteger('sort_order')->default(0)->index(); // 🔹 сортировка
            $table->timestamps();

            $table->index('parent_id'); // 🔹 дерево
        });

        Schema::create('category_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->string('language', 2); // ru, ro, en
            $table->string('name');
            $table->string('slug')->nullable(); // для SEO
            $table->timestamps();

            $table->unique(['category_id', 'language']);      // 🔹 1 запись на язык в категории
            $table->unique(['language', 'slug']);             // 🔹 уникальный slug в рамках языка
            $table->index('slug');                            // 🔹 быстрый поиск по slug
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('category_translations');
        Schema::dropIfExists('categories');
    }
};
