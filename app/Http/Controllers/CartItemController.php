<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartItemController extends Controller
{
    // Tambah produk ke cart
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required',
        ]);

        $user = Auth::user();

        // Ambil atau buat cart milik user
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        $item = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($item) {
            $item->quantity += $request->quantity;
            $item->save();
        } else {
            $cart->items()->create([
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }

        // Mengembalikan jumlah item dalam cart sebagai response JSON
        return response()->json([
            'cartCount' => $cart->items->count()
        ]);
    }

    // Update quantity item
    public function update(Request $request, CartItem $item)
    {
        $request->validate([
            'action' => 'required|in:increase,decrease',
        ]);

        if ($item->cart->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $message = 'Cart updated.';
        $deleted = false;

        if ($request->action === 'increase') {
            $item->increment('quantity');
        } elseif ($request->action === 'decrease') {
            if ($item->quantity > 1) {
                $item->decrement('quantity');
            } else {
                $deleted = true;
                $item->delete();
                $message = 'Item removed from cart.';
            }
        }

        $cart = $item->cart;

        return response()->json([
            'cartCount' => $cart->items->count(),
            'message' => $message,
            'deleted' => $deleted,
            'itemId' => $item->id,
            'itemQuantity' => $item->quantity,
            'itemTotal' => $item->product->price * $item->quantity,
            'cartTotalQuantity' => $cart->items->sum('quantity'),
            'cartTotalPrice' => $cart->items->sum(fn($i) => $i->product->price * $i->quantity),
        ]);
    }


    // Hapus item dari cart
    public function destroy(CartItem $item)
    {
        if ($item->cart->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $item->delete();

        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }
}
