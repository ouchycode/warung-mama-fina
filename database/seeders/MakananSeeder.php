<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Makanan;

class MakananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Makanan::insert([
            ['nama' => 'Salad Buah', 'harga' => 25000],
            ['nama' => 'Wrap Ayam', 'harga' => 30000],
            ['nama' => 'Cold Press Juice', 'harga' => 20000],
        ]);
    }
}
