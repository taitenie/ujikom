<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Menampilkan halaman keranjang dengan item yang ada
    public function index()
    {
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $items = $cart->items()->with('product')->get();

        return view('user.cart', compact('cart', 'items'));
    }
}
