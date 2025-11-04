<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
  {
    // Use raw SQL to avoid requiring doctrine/dbal
    DB::statement("ALTER TABLE `pengaduans` MODIFY `email` VARCHAR(255) NULL;");
  }

  public function down()
  {
    // Revert to NOT NULL with empty string default if needed
    DB::statement("ALTER TABLE `pengaduans` MODIFY `email` VARCHAR(255) NOT NULL DEFAULT '';");
  }
};
