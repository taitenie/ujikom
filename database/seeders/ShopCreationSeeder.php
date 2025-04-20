<?php

namespace Database\Seeders;

use App\Models\ShopCreation;
use Illuminate\Database\Seeder;

class ShopCreationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ShopCreation::create([
            'name' => 'Toko Sehat Abadi',
            'description' => 'Menjual alat kesehatan dan obat herbal',
            'user_id' => 1,
            'status' => 'pending',
        ]);

        ShopCreation::create([
            'name' => 'Apotek Harmoni',
            'description' => 'Apotek dengan berbagai obat resep dan non-resep',
            'user_id' => 2,
            'status' => 'pending',
        ]);

        ShopCreation::create([
            'name' => 'Klinik Keluarga',
            'description' => 'Layanan kesehatan keluarga dan penjualan alat medis',
            'user_id' => 2,
            'status' => 'pending',
        ]);
    }
}
