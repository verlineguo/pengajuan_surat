<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('prodi')->insert([
            ['kode_prodi' => 'TI', 'nama_prodi' => 'Sarjana Teknik Informatika'],
            ['kode_prodi' => 'SI', 'nama_prodi' => 'Sarjana Sistem Informasi'],
            ['kode_prodi' => 'MIK', 'nama_prodi' => 'Magister Ilmu Komputer'],
        ]);
    }
}
