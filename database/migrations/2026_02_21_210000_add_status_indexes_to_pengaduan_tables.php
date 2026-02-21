<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('pengaduans') && Schema::hasColumn('pengaduans', 'status')) {
            Schema::table('pengaduans', function (Blueprint $table) {
                $table->index('status', 'pengaduans_status_idx');
            });
        }

        if (Schema::hasTable('pengaduan_progress') && Schema::hasColumn('pengaduan_progress', 'status')) {
            Schema::table('pengaduan_progress', function (Blueprint $table) {
                $table->index('status', 'pengaduan_progress_status_idx');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('pengaduans')) {
            Schema::table('pengaduans', function (Blueprint $table) {
                $table->dropIndex('pengaduans_status_idx');
            });
        }

        if (Schema::hasTable('pengaduan_progress')) {
            Schema::table('pengaduan_progress', function (Blueprint $table) {
                $table->dropIndex('pengaduan_progress_status_idx');
            });
        }
    }
};

