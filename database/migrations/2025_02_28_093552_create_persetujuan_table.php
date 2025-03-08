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
        Schema::create('persetujuan', function (Blueprint $table) {
            $table->id('id_persetujuan')->primary(); // Primary Key, Auto Increment
            $table->bigInteger('id_pengajuan')->unsigned(); // Foreign Key ke tabel pengajuan
            $table->string('nik_kaprodi'); // Foreign Key ke tabel kaprodi
            $table->dateTime('tanggal_persetujuan'); // Waktu persetujuan
            $table->string('status_persetujuan'); // Status persetujuan
            $table->text('catatan_kaprodi')->nullable(); // Catatan, nullable

            // Foreign Key Constraints
            $table->foreign('id_pengajuan')->references('id_pengajuan')->on('pengajuan');
            $table->foreign('nik_kaprodi')->references('nomor_induk')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persetujuan');
    }
};
