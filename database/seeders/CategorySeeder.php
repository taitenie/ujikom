<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Alat Medis',
            'description' => 'Peralatan medis untuk klinik dan rumah sakit',
        ]);

        Category::create([
            'name' => 'Obat-obatan',
            'description' => 'Obat resep dan non-resep',
        ]);

        Category::create([
            'name' => 'Perawatan Pribadi',
            'description' => 'Alat kebersihan dan perawatan diri',
        ]);
    }
}
