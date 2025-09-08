<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // атрибуты (цвет, размер...)
        Schema::create('product_attributes', function (Blueprint $t) {
            $t->id();
            $t->string('type', 20)->default('select'); // select|multiselect|text|number|boolean (пока используем select)
            $t->string('unit')->nullable();            // мм, кг и т.п.
            $t->boolean('is_filterable')->default(true)->index();
            $t->boolean('is_variant')->default(false)->index(); // на вырост под вариации
            $t->unsignedInteger('sort_order')->default(0)->index();
            $t->timestamps();
        });

        // переводы атрибутов
        Schema::create('attribute_translations', function (Blueprint $t) {
            $t->id();
            $t->foreignId('attribute_id')->constrained('product_attributes')->cascadeOnDelete();
            $t->string('language', 2);
            $t->string('name');
            $t->timestamps();

            $t->unique(['attribute_id', 'language']);
        });

        // значения атрибутов
        Schema::create('attribute_values', function (Blueprint $t) {
            $t->id();
            $t->foreignId('attribute_id')->constrained('product_attributes')->cascadeOnDelete();
            $t->unsignedInteger('sort_order')->default(0)->index();
            $t->timestamps();
        });

        // переводы значений
        Schema::create('attribute_value_translations', function (Blueprint $t) {
            $t->id();
            $t->foreignId('attribute_value_id')->constrained('attribute_values')->cascadeOnDelete();
            $t->string('language', 2);
            $t->string('value');
            $t->timestamps();

            $t->unique(['attribute_value_id', 'language']);
        });

        // привязка товара к (атрибут, значение)
        Schema::create('product_attribute_values', function (Blueprint $t) {
            $t->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $t->foreignId('attribute_id')->constrained('product_attributes')->cascadeOnDelete();
            $t->foreignId('attribute_value_id')->constrained('attribute_values')->cascadeOnDelete();
            $t->unique(['product_id', 'attribute_id', 'attribute_value_id'], 'prod_attr_val_unique');
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_attribute_values');
        Schema::dropIfExists('attribute_value_translations');
        Schema::dropIfExists('attribute_values');
        Schema::dropIfExists('attribute_translations');
        Schema::dropIfExists('product_attributes');
    }
};
