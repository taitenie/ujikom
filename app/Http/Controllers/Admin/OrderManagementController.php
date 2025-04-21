<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua pesanan dengan relasi user
        $orders = Order::with('user')->get();

        // Kirim data ke view
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Ambil pesanan berdasarkan ID
        $order = Order::with('user')->findOrFail($id);

        // Kirim data ke view
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Order $order, $status)
    {
        if ($order->status !== 'pending') {
            return redirect()->back()->with('error', 'Only pending orders can be updated.');
        }

        if (!in_array($status, ['shipped', 'cancelled'])) {
            return redirect()->back()->with('error', 'Invalid status.');
        }

        // Perbarui status pesanan
        $order->update(['status' => $status]);

        return redirect()->route('admin.orders.index')->with('success', 'Order status updated successfully.');
    }
}
