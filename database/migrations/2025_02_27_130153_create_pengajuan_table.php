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
            $table->string('nrp');
            $table->bigInteger('id_document')->unsigned();  
            $table->datetime('tanggal_pengajuan');
            $table->string('catatan', 255)->nullable();
            $table->foreign('nrp')->references('nomor_induk')->on('users');
            $table->foreign('id_document')->references('id_document')->on('document');
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
