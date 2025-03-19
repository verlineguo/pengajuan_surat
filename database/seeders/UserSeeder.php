<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'nomor_induk' => '2372901',
            'name' => 'Verline',
            'email' => '2372901@maranatha.ac.id',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), // Ganti password dengan yang lebih aman
            'role_id' => 1, 
            'profile' => null,
            'phone' => null,
            'address' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
