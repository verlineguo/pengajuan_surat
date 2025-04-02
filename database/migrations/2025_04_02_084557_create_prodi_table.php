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
        Schema::create('prodi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_prodi');
            $table->string('kode_prodi', 10)->unique();
            $table->string('kaprodi_id', 10)->nullable(); // Foreign Key ke Users (nomor_induk)
            $table->string('tu_id', 10)->nullable(); // Foreign Key ke Users (nomor_induk)
            
            $table->foreign('kaprodi_id')->references('nomor_induk')->on('users');
            $table->foreign('tu_id')->references('nomor_induk')->on('users');
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prodi');
    }
};
