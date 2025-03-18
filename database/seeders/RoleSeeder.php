<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('role')->insert([
            ['id' => 1, 'name' => 'admin'],
            ['id' => 2, 'name' => 'tu'],
            ['id' => 3, 'name' => 'kaprodi'],
            ['id' => 4, 'name' => 'mahasiswa'],
        ]);
    }
}
