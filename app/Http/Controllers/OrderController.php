<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Fungsi Checkout (Order)
    public function checkout(Request $request)
    {
        $request->validate([
            'payment_type' => 'required|in:prepaid,postpaid',
            'payment_method' => 'required|in:bank,paypal,cash',
            'bank_name' => 'required_if:payment_method,bank_transfer',
        ]);

        $cart = Cart::with('items.product')->where('user_id', Auth::id())->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'status' => 'pending',
            'payment_type' => $request->payment_type,
            'payment_method' => $request->payment_method,
            'bank_name' => $request->bank_name,
        ]);

        foreach ($cart->items as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->price,
            ]);
        }

        $cart->items()->delete();
        $cart->delete();

        return redirect()->route('struk.index', ['order' => $order->id])->with('success', 'Checkout successful. Your order is being processed.');
    }

    public function index()
    {
        $orders = Order::with('user')->get();

        return view('user.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['user', 'items.product'])->find($id);

        // Pastikan order hanya bisa diakses oleh pemiliknya
        if (!$order || $order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this order.');
        }

        return view('user.struk', compact('order'));
    }

    public function cancel(Order $order)
    {
        $user = Auth::user();

        // Pastikan user adalah pemilik order
        if ($order->user_id !== $user->id) {
            abort(403, 'Unauthorized');
        }

        // Cek apakah status masih bisa dibatalkan
        if ($order->status !== 'pending') {
            return redirect()->back()->with('error', 'Order sudah diproses dan tidak bisa dibatalkan.');
        }

        $order->update(['status' => 'cancelled']);

        return redirect()->back()->with('success', 'Order berhasil dibatalkan.');
    }

    // Admin mengubah status order menjadi shipped
    public function updateStatus(Order $order, $status)
    {
        // Cek apakah yang mengakses adalah admin
        if (!Auth::user()->is_admin) {
            abort(403);
        }

        // Validasi status
        if (!in_array($status, ['pending', 'shipped', 'received'])) {
            abort(400);
        }

        $order->status = $status;
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Order status updated.');
    }
}
