<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up()
  {
    Schema::table('profil_desas', function (Blueprint $table) {
      $table->dropColumn('sambutan_kades');
    });
  }
  public function down()
  {
    Schema::table('profil_desas', function (Blueprint $table) {
      $table->text('sambutan_kades')->nullable();
    });
  }
};
