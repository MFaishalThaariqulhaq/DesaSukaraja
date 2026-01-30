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
    Schema::table('profil_desas', function (Blueprint $table) {
      $table->text('deskripsi_profil')->nullable()->after('isi');
      $table->text('motto_profil')->nullable()->after('deskripsi_profil');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('profil_desas', function (Blueprint $table) {
      $table->dropColumn(['deskripsi_profil', 'motto_profil']);
    });
  }
};
