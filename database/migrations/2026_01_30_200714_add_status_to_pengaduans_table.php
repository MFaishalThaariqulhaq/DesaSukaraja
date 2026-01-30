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
        Schema::table('pengaduans', function (Blueprint $table) {
            // Check if columns don't exist before adding
            if (!Schema::hasColumn('pengaduans', 'tracking_number')) {
                $table->string('tracking_number')->unique()->after('id');
            }
            if (!Schema::hasColumn('pengaduans', 'admin_notes')) {
                $table->text('admin_notes')->nullable()->after('isi');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            if (Schema::hasColumn('pengaduans', 'tracking_number')) {
                $table->dropColumn('tracking_number');
            }
            if (Schema::hasColumn('pengaduans', 'admin_notes')) {
                $table->dropColumn('admin_notes');
            }
        });
    }
};
