<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('pengaduan_progress')) {
            return;
        }

        Schema::create('pengaduan_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengaduan_id')->constrained('pengaduans')->cascadeOnDelete();
            $table->string('status')->nullable();
            $table->text('note')->nullable();
            $table->string('photo_path')->nullable();
            $table->boolean('is_public')->default(true);
            $table->string('created_by')->nullable();
            $table->timestamps();

            $table->index(['pengaduan_id', 'is_public']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaduan_progress');
    }
};
