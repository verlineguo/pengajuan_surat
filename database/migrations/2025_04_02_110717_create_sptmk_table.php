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
        Schema::create('sptmk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengajuan_id');
            $table->string('tujukan');
            $table->string('mata_kuliah');
            $table->string('semester');
            $table->text('data_mahasiswa');
            $table->string('tujuan');
            $table->string('topik');
            $table->timestamps();
    
            $table->foreign('pengajuan_id')->references('id_pengajuan')->on('pengajuan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sptmk');
    }
};
