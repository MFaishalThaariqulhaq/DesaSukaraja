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
            // Pendidikan
            $table->integer('pendidikan_sd')->nullable()->default(0)->after('wna');
            $table->integer('pendidikan_smp')->nullable()->default(0)->after('pendidikan_sd');
            $table->integer('pendidikan_sma')->nullable()->default(0)->after('pendidikan_smp');
            $table->integer('pendidikan_diploma')->nullable()->default(0)->after('pendidikan_sma');
            $table->integer('pendidikan_belum')->nullable()->default(0)->after('pendidikan_diploma');

            // Pekerjaan
            $table->integer('pekerjaan_petani')->nullable()->default(0)->after('pendidikan_belum');
            $table->integer('pekerjaan_wiraswasta')->nullable()->default(0)->after('pekerjaan_petani');
            $table->integer('pekerjaan_karyawan')->nullable()->default(0)->after('pekerjaan_wiraswasta');
            $table->integer('pekerjaan_pns')->nullable()->default(0)->after('pekerjaan_karyawan');
            $table->integer('pekerjaan_ibu_rumah_tangga')->nullable()->default(0)->after('pekerjaan_pns');
            $table->integer('pekerjaan_belum')->nullable()->default(0)->after('pekerjaan_ibu_rumah_tangga');

            // Agama
            $table->integer('agama_islam')->nullable()->default(0)->after('pekerjaan_belum');
            $table->integer('agama_kristen')->nullable()->default(0)->after('agama_islam');
            $table->integer('agama_katolik')->nullable()->default(0)->after('agama_kristen');
            $table->integer('agama_hindu')->nullable()->default(0)->after('agama_katolik');
            $table->integer('agama_buddha')->nullable()->default(0)->after('agama_hindu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penduduks', function (Blueprint $table) {
            $table->dropColumn([
                'pendidikan_sd',
                'pendidikan_smp',
                'pendidikan_sma',
                'pendidikan_diploma',
                'pendidikan_belum',
                'pekerjaan_petani',
                'pekerjaan_wiraswasta',
                'pekerjaan_karyawan',
                'pekerjaan_pns',
                'pekerjaan_ibu_rumah_tangga',
                'pekerjaan_belum',
                'agama_islam',
                'agama_kristen',
                'agama_katolik',
                'agama_hindu',
                'agama_buddha'
            ]);
        });
    }
};
