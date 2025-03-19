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
        Schema::create('detail_surat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_id');
            $table->string('semester')->nullable();
            $table->string('alamat_bandung')->nullable();
            $table->text('keperluan')->nullable();
            $table->string('tujuan')->nullable();
            $table->string('tujukan')->nullable();
            $table->string('mata_kuliah')->nullable();
            $table->text('data_mahasiswa')->nullable();
            $table->string('topik')->nullable();
            $table->date('tanggal_kelulusan')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_surat');
    }
};
