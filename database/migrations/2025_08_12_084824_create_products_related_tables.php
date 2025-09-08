<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Основная таблица товаров
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->nullable()->constrained('brands')->nullOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->string('sku')->unique(); // артикул
            $table->decimal('price', 10, 2)->default(0);
            $table->string('currency', 3)->default('MDL'); // опционально для мультирегиональности
            $table->boolean('is_active')->default(true)->index();
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->timestamps();
        });

        // Переводы товаров
        Schema::create('product_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->string('language', 2); // ru, ro, en
            $table->string('name');
            $table->string('slug')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('full_description')->nullable();
            $table->timestamps();

            $table->unique(['product_id', 'language']);
            $table->unique(['language', 'slug']);
        });

        // Картинки товаров
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->string('path');
            $table->boolean('is_main')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_images');
        Schema::dropIfExists('product_translations');
        Schema::dropIfExists('products');
    }
};
