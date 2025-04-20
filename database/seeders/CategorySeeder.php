<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            ['name' => 'Alat Medis', 'description' => 'Peralatan medis untuk klinik dan rumah sakit'],
            ['name' => 'Obat-obatan', 'description' => 'Obat resep dan non-resep'],
            ['name' => 'Perawatan Pribadi', 'description' => 'Alat kebersihan dan perawatan diri'],
        ]);
    }
}
