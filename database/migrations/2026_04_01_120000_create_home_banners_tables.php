<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_banners', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->default(true)->index();
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->string('link')->nullable();
            $table->boolean('open_in_new_tab')->default(false);
            $table->timestamps();
        });

        Schema::create('home_banner_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('home_banner_id')->constrained('home_banners')->cascadeOnDelete();
            $table->string('language', 2);
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('button_text')->nullable();
            $table->string('image_desktop');
            $table->string('image_mobile');
            $table->timestamps();

            $table->unique(['home_banner_id', 'language']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_banner_translations');
        Schema::dropIfExists('home_banners');
    }
};
