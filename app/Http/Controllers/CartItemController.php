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
            'quantity' => 'required|integer|min:1',
        ]);

        $user = Auth::user();

        // Ambil atau buat cart milik user
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        $product = Product::findOrFail($request->product_id);
        $requestedQty = (int) $request->quantity;

        // Cek apakah item sudah ada di cart
        $item = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        // Total quantity yang diminta
        $existingQty = $item ? $item->quantity : 0;
        $totalRequested = $existingQty + $requestedQty;

        if ($totalRequested > $product->stock) {
            return response()->json([
                'status' => 'error',
                'message' => 'Jumlah melebihi stok yang tersedia.'
            ], 400);
        }

        if ($item) {
            $item->quantity = $totalRequested;
            $item->save();
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $requestedQty,
            ]);
        }

        return response()->json([
            'cartCount' => $cart->items->count()
        ]);
    }

    // Update quantity item
    public function update(Request $request, CartItem $item)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        if ($item->cart->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $item->update([
            'quantity' => $request->quantity,
        ]);

<<<<<<< HEAD
        $cart = $item->cart->fresh();
        $item = $item->fresh();
=======
        if ($request->action === 'increase') {
            if ($item->quantity < $item->product->stock) {
                $item->increment('quantity');
            } else {
                return response()->json([
                    'message' => 'Stok tidak mencukupi.'
                ], 400);
            }
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
>>>>>>> origin/main

        return response()->json([
            'cartCount' => $cart->items->count(),
            'message' => 'Cart updated.',
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