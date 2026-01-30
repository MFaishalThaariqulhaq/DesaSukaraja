<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up()
  {
    Schema::create('sejarah_desas', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('profil_desa_id')->nullable();
      $table->string('tahun')->nullable();
      $table->string('judul')->nullable();
      $table->text('deskripsi')->nullable();
      $table->string('gambar')->nullable();
      $table->timestamps();
    });
  }
  public function down()
  {
    Schema::dropIfExists('sejarah_desas');
  }
};
