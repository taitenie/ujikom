<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Mail\OrderReceiptMail;
use Illuminate\Support\Facades\Mail;


class OrderController extends Controller
{
    // Fungsi Checkout (Order)
    public function checkout(Request $request)
    {
        $request->validate([
            'payment_type' => 'required|in:prepaid,postpaid',
            'payment_method' => 'required|in:bank,paypal,cash',
            'bank_name' => 'required_if:payment_method,bank',
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

            $cartItem->product->stock -= $cartItem->quantity;
            $cartItem->product->save();
        }

        // Bersihkan keranjang
        $cart->items()->delete();
        $cart->delete();

        // Generate PDF dari view struk.blade.php
        $pdf = PDF::loadView('user.struk', ['order' => $order]);

        // Kirim email ke user dengan PDF
        Mail::to(Auth::user()->email)->send(new OrderReceiptMail($pdf));

        return redirect()->route('struk.show', ['struk' => $order->id])
            ->with('success', 'Checkout berhasil. Struk telah dikirim ke email Anda.');
    }

    public function index()
    {
        $startTime = microtime(true);
        $startMemory = memory_get_usage(); // Mulai pengukuran memori

        // Ambil order milik user yang sedang login
        $orders = Order::with('user')->where('user_id', Auth::id())->get();

        $endTime = microtime(true); // Akhir pengukuran waktu
        $executionTime = $endTime - $startTime; // Hitung waktu eksekusi

        $endMemory = memory_get_usage(); // Akhir pengukuran memori
        $memoryUsage = $endMemory - $startMemory; // Hitung memori yang digunakan

        return view('user.orders.index', compact('orders', 'executionTime', 'memoryUsage'));
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

        // Kembalikan stok produk
        foreach ($order->items as $item) {
            $product = $item->product;
            $product->stock += $item->quantity;
            $product->save();
        }

        return redirect()->back()->with('success', 'Order berhasil dibatalkan.');
    }

    public function updateStatus(Request $request, Order $order, $status)
    {
        $user = Auth::user();

        // Pastikan user adalah pemilik order
        if ($order->user_id !== $user->id) {
            abort(403, 'Unauthorized');
        }

        // Validasi status
        if (!in_array($status, ['received'])) {
            abort(400, 'Invalid status.');
        }

        // Simpan feedback jika ada
        if ($status === 'received') {
            $request->validate([
                'feedback' => 'required|string|max:500',
            ]);

            $order->feedback = $request->feedback;
        }

        $order->status = $status;
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Order status updated successfully.');
    }
}
