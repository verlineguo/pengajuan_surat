<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuratSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk mengisi tabel surat.
     */
    public function run()
    {
        DB::table('surat')->insert([
            ['nama_jenis_surat' => 'Surat Keterangan Mahasiswa Aktif', 'created_at' => now(), 'updated_at' => now()],
            ['nama_jenis_surat' => 'Surat Pengantar Tugas Mata Kuliah', 'created_at' => now(), 'updated_at' => now()],
            ['nama_jenis_surat' => 'Surat Keterangan Lulus', 'created_at' => now(), 'updated_at' => now()],
            ['nama_jenis_surat' => 'Laporan Hasil Studi', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
