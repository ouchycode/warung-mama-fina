<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'pelanggan@example.com'],
            [
                'name' => 'Pelanggan Satu',
                'password' => Hash::make('password'),
                'role' => 'pelanggan',
            ]
        );

        User::firstOrCreate(
            ['email' => 'pegawai@example.com'],
            [
                'name' => 'Pegawai Satu',
                'password' => Hash::make('password'),
                'role' => 'pegawai',
            ]
        );

        User::firstOrCreate(
            ['email' => 'kurir@example.com'],
            [
                'name' => 'Kurir Satu',
                'password' => Hash::make('password'),
                'role' => 'kurir',
            ]
        );
    }
}
