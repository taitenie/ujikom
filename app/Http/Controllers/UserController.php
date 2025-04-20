<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        $categories = Category::withCount('products')->get();

        return view('user.dashboard', compact('products', 'categories'));
    }

    public function filterByCategory(Category $category)
    {
        $products = $category->products()->get();
        $categories = Category::withCount('products')->get();

        return view('user.dashboard', compact('products', 'categories'));
    }
}
