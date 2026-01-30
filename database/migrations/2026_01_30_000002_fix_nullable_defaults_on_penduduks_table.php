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
        Schema::table('penduduks', function (Blueprint $table) {
            // Kelompok Usia - Add default 0 if not exists
            if (Schema::hasColumn('penduduks', 'kelompok_usia_0_5')) {
                $table->integer('kelompok_usia_0_5')->nullable()->default(0)->change();
            }
            if (Schema::hasColumn('penduduks', 'kelompok_usia_6_11')) {
                $table->integer('kelompok_usia_6_11')->nullable()->default(0)->change();
            }
            if (Schema::hasColumn('penduduks', 'kelompok_usia_12_17')) {
                $table->integer('kelompok_usia_12_17')->nullable()->default(0)->change();
            }
            if (Schema::hasColumn('penduduks', 'kelompok_usia_18_25')) {
                $table->integer('kelompok_usia_18_25')->nullable()->default(0)->change();
            }
            if (Schema::hasColumn('penduduks', 'kelompok_usia_26_35')) {
                $table->integer('kelompok_usia_26_35')->nullable()->default(0)->change();
            }
            if (Schema::hasColumn('penduduks', 'kelompok_usia_36_45')) {
                $table->integer('kelompok_usia_36_45')->nullable()->default(0)->change();
            }
            if (Schema::hasColumn('penduduks', 'kelompok_usia_46_60')) {
                $table->integer('kelompok_usia_46_60')->nullable()->default(0)->change();
            }
            if (Schema::hasColumn('penduduks', 'kelompok_usia_61_keatas')) {
                $table->integer('kelompok_usia_61_keatas')->nullable()->default(0)->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Not needed for rollback
    }
};
