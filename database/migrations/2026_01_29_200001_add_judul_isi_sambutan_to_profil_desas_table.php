<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up()
  {
    Schema::table('profil_desas', function (Blueprint $table) {
      $table->string('judul_sambutan_kades')->nullable();
      $table->text('isi_sambutan_kades')->nullable();
    });
  }
  public function down()
  {
    Schema::table('profil_desas', function (Blueprint $table) {
      $table->dropColumn(['judul_sambutan_kades', 'isi_sambutan_kades']);
    });
  }
};
