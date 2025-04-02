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
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id('id_pengajuan')->primary();
            $table->unsignedBigInteger('id_surat');  
            $table->string('nrp');
            $table->datetime('tanggal_pengajuan');
            $table->string('status_pengajuan', 10);
            $table->datetime('tanggal_persetujuan')->nullable();
            $table->string('catatan_kaprodi', 255)->nullable();
            $table->string('catatan_tu', 255)->nullable();
            $table->string('file_surat')->nullable();
            $table->foreign('nrp')->references('nomor_induk')->on('users');
            $table->foreign('id_surat')->references('id')->on('surat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan');
    }
};
