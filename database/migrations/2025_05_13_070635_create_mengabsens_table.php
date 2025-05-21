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
        Schema::create('mengabsens', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_absen');
            $table->time('jam_absen')->nullable();
            $table->enum('status', ['hadir', 'izin', 'sakit', 'alpa']);
            $table->foreignId('id_siswa')->references('id')->on('siswas')->onDelete('cascade');
            $table->foreignId('id_guru')->references('id')->on('gurus')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mengabsens');
    }
};