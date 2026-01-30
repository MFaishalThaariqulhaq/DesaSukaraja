<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up()
  {
    Schema::table('profil_desas', function (Blueprint $table) {
      $table->string('nama_kades')->nullable();
      $table->string('periode_kades')->nullable();
      $table->string('foto_kades')->nullable();
      $table->text('sambutan_kades')->nullable();
      $table->string('ttd_kades')->nullable();
    });
  }
  public function down()
  {
    Schema::table('profil_desas', function (Blueprint $table) {
      $table->dropColumn(['nama_kades', 'periode_kades', 'foto_kades', 'sambutan_kades', 'ttd_kades']);
    });
  }
};
