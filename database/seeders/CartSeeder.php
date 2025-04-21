<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $products = Product::all();

        if ($products->count() === 0) {
            $this->command->info('No products found. Please seed products first.');
            return;
        }

        foreach ($users as $user) {
            $cart = Cart::create([
                'user_id' => $user->id,
            ]);

            // Tambahkan 1-3 produk acak ke cart
            $randomProducts = $products->random(rand(1, 3));

            foreach ($randomProducts as $product) {
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'quantity' => rand(1, 5),
                ]);
            }
        }
    }
}
