<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $alatMedis = Category::where('name', 'Alat Medis')->first();
        $obat = Category::where('name', 'Obat-obatan')->first();
        $perawatan = Category::where('name', 'Perawatan Pribadi')->first();

        Product::insert([
            [
                'name' => 'Termometer Digital',
                'description' => 'Mengukur suhu tubuh secara akurat',
                'price' => 75000,
                'stock' => 50,
                'image' => null,
                'category_id' => $alatMedis->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tensimeter Manual',
                'description' => 'Mengukur tekanan darah dengan akurasi tinggi',
                'price' => 150000,
                'stock' => 30,
                'image' => null,
                'category_id' => $alatMedis->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Paracetamol 500mg',
                'description' => 'Obat penurun panas dan pereda nyeri',
                'price' => 15000,
                'stock' => 200,
                'image' => null,
                'category_id' => $obat->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Amoxicillin 250mg',
                'description' => 'Antibiotik untuk infeksi bakteri ringan hingga sedang',
                'price' => 25000,
                'stock' => 150,
                'image' => null,
                'category_id' => $obat->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Masker Medis 3 Lapis',
                'description' => 'Perlindungan dari bakteri dan virus',
                'price' => 50000,
                'stock' => 300,
                'image' => null,
                'category_id' => $perawatan->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hand Sanitizer 250ml',
                'description' => 'Membersihkan tangan tanpa air, efektif membunuh kuman',
                'price' => 30000,
                'stock' => 100,
                'image' => null,
                'category_id' => $perawatan->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
