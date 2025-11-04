<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
  {
    if (!Schema::hasTable('pengaduans')) {
      Schema::create('pengaduans', function (Blueprint $table) {
        $table->id();
        $table->string('nama')->nullable();
        $table->string('email')->nullable();
        $table->string('telepon')->nullable();
        $table->string('alamat')->nullable();
        $table->string('kategori')->nullable();
        $table->string('judul')->nullable();
        $table->text('isi');
        $table->string('file_path')->nullable();
        $table->enum('status', ['pending', 'in_progress', 'resolved', 'rejected'])->default('pending');
        $table->enum('urgency', ['low', 'medium', 'high'])->default('medium');
        $table->decimal('lat', 10, 7)->nullable();
        $table->decimal('lng', 10, 7)->nullable();
        $table->text('internal_notes')->nullable();
        $table->unsignedBigInteger('handled_by')->nullable();
        $table->timestamps();
      });
    } else {
      Schema::table('pengaduans', function (Blueprint $table) {
        if (!Schema::hasColumn('pengaduans', 'telepon')) {
          $table->string('telepon')->nullable()->after('email');
        }
        if (!Schema::hasColumn('pengaduans', 'alamat')) {
          $table->string('alamat')->nullable()->after('telepon');
        }
        if (!Schema::hasColumn('pengaduans', 'kategori')) {
          $table->string('kategori')->nullable()->after('alamat');
        }
        if (!Schema::hasColumn('pengaduans', 'judul')) {
          $table->string('judul')->nullable()->after('kategori');
        }
        if (!Schema::hasColumn('pengaduans', 'file_path')) {
          $table->string('file_path')->nullable()->after('isi');
        }
        if (!Schema::hasColumn('pengaduans', 'status')) {
          $table->enum('status', ['pending', 'in_progress', 'resolved', 'rejected'])->default('pending')->after('file_path');
        }
        if (!Schema::hasColumn('pengaduans', 'urgency')) {
          $table->enum('urgency', ['low', 'medium', 'high'])->default('medium')->after('status');
        }
        if (!Schema::hasColumn('pengaduans', 'lat')) {
          $table->decimal('lat', 10, 7)->nullable()->after('urgency');
        }
        if (!Schema::hasColumn('pengaduans', 'lng')) {
          $table->decimal('lng', 10, 7)->nullable()->after('lat');
        }
        if (!Schema::hasColumn('pengaduans', 'internal_notes')) {
          $table->text('internal_notes')->nullable()->after('lng');
        }
        if (!Schema::hasColumn('pengaduans', 'handled_by')) {
          $table->unsignedBigInteger('handled_by')->nullable()->after('internal_notes');
        }
      });
    }
  }

  public function down()
  {
    Schema::dropIfExists('pengaduans');
  }
};
