<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();

            // 1 к 1: один товар -> одна акция (если нужно несколько акций на товар позже — уберем unique)
            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete()
                ->unique();

            // Тип акции: discount | gift
            $table->string('type', 20);

            // Общие поля
            $table->string('title')->nullable();       // можно показывать в админке / на сайте
            $table->boolean('is_active')->default(true);
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->unsignedInteger('priority')->default(100);

            // Discount
            $table->decimal('discount_price', 10, 2)->nullable();

            // Gift
            $table->foreignId('gift_product_id')
                ->nullable()
                ->constrained('products')
                ->nullOnDelete();

            $table->unsignedInteger('gift_quantity')->nullable();

            $table->timestamps();

            $table->index(['type', 'is_active']);
            $table->index(['starts_at', 'ends_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
