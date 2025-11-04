<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
  {
    Schema::create('pengaduan_logs', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('pengaduan_id');
      $table->string('action');
      $table->json('meta')->nullable();
      $table->timestamps();

      $table->foreign('pengaduan_id')->references('id')->on('pengaduans')->onDelete('cascade');
    });
  }

  public function down()
  {
    Schema::dropIfExists('pengaduan_logs');
  }
};
