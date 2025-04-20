<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        // Retrieve the cart from session or initialize as empty
        $cart = session()->get('cart', []);

        // Calculate total price and total quantity
        $totalPrice = 0;
        $totalQuantity = 0;

        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
            $totalQuantity += $item['quantity'];
        }

        // Return view with cart data, total price, and total quantity
        return view('user.cart', compact('cart', 'totalPrice', 'totalQuantity'));
    }

    public function add(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Retrieve the cart from session or initialize as empty
        $cart = session()->get('cart', []);
        $productId = $validated['product_id'];
        $quantity = $validated['quantity'];

        // If product not in cart, add it
        if (!isset($cart[$productId])) {
            $product = Product::findOrFail($productId);
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
            ];
        } else {
            // Update quantity if product is already in cart
            $cart[$productId]['quantity'] += $quantity;
        }

        // Save the updated cart to the session
        session()->put('cart', $cart);

        // Return JSON response to frontend
        return response()->json([
            'success' => true,
            'cartCount' => count($cart),
            'totalPrice' => number_format(
                array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)),
                0,
                ',',
                '.'
            ),
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'action' => 'required|in:increase,decrease',
        ]);

        $cart = session()->get('cart', []);
        $productId = $validated['product_id'];

        if (isset($cart[$productId])) {
            if ($validated['action'] === 'increase') {
                $cart[$productId]['quantity'] += 1;
            } elseif ($validated['action'] === 'decrease') {
                $cart[$productId]['quantity'] -= 1;
                if ($cart[$productId]['quantity'] <= 0) {
                    unset($cart[$productId]); // langsung hapus
                }
            }
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Cart updated.');
    }

    public function remove(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        // Retrieve the cart from session
        $cart = session()->get('cart', []);
        $productId = $validated['product_id'];

        // Remove product from cart if it exists
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
        }

        // Save the updated cart back to session
        session()->put('cart', $cart);

        // Redirect to the cart page with updated cart
        return redirect()->route('cart.index');
    }
}
