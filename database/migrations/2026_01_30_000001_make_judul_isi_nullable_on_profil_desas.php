<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up()
  {
    Schema::table('profil_desas', function (Blueprint $table) {
      $table->string('judul')->nullable()->change();
      $table->text('isi')->nullable()->change();
    });
  }
  public function down()
  {
    Schema::table('profil_desas', function (Blueprint $table) {
      $table->string('judul')->nullable(false)->change();
      $table->text('isi')->nullable(false)->change();
    });
  }
};
