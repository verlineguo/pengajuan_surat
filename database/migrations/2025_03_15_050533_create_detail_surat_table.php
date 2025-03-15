<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\text;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_surat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_jenis_document');
            $table->text('isi_document');
            $table->datetime('tanggal_pembuatan');
            $table->string('file_document', 255);
            $table->timestamps();

            $table->foreign('id_jenis_document')->references('id')->on('document');
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
