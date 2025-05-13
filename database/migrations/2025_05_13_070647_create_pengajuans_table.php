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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->string('keterangan');
            $table->date('tanggal_pengajuan');
            $table->time('jam_absen');
            $table->enum('status', ['diterima', 'ditolak', 'menunggu']);
            $table->string('foto');
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
        Schema::dropIfExists('pengajuans');
    }
};