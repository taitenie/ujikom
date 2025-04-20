<?php

namespace App\Http\Controllers;

use App\Models\ShopCreation;
use Illuminate\Http\Request;

class ShopCreationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shops = ShopCreation::all();
        return view('admin.shopcreations.index', compact('shops'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ShopCreation $shopCreation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShopCreation $shopCreation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ShopCreation $shop)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected,pending',
        ]);

        $shop->status = $request->input('status');
        $shop->save();

        return redirect()->route('shops.index')->with('success', 'Shop status updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShopCreation $shopCreation)
    {
        //
    }
}
