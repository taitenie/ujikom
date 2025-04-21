<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StrukController extends Controller
{
    public function show($struk)
    {
        $order = Order::with('items.product', 'user')->findOrFail($struk);
        return view('user.struk', compact('order'));
    }
}
