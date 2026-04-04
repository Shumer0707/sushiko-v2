<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('home_banners') || Schema::hasColumn('home_banners', 'overlay_opacity')) {
            return;
        }

        Schema::table('home_banners', function (Blueprint $table) {
            $table->unsignedTinyInteger('overlay_opacity')->default(0)->after('sort_order');
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('home_banners') || ! Schema::hasColumn('home_banners', 'overlay_opacity')) {
            return;
        }

        Schema::table('home_banners', function (Blueprint $table) {
            $table->dropColumn('overlay_opacity');
        });
    }
};
