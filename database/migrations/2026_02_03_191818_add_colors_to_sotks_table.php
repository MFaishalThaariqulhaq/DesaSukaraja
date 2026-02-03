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
        Schema::table('sotks', function (Blueprint $table) {
            $table->string('badge_color')->default('#10b981')->comment('Color untuk badge/label');
            $table->string('overlay_bg_color')->default('rgba(5, 55, 50, 0.95)')->comment('Background color untuk overlay');
            $table->string('icon_color')->default('#6ee7b7')->comment('Color untuk icon di overlay');
            $table->string('icon_name')->default('book-open')->comment('Icon name dari lucide icons');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sotks', function (Blueprint $table) {
            $table->dropColumn(['badge_color', 'overlay_bg_color', 'icon_color', 'icon_name']);
        });
    }
};
