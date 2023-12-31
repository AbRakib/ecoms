<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ShopController extends Controller {
    public function index() {
        $products = Product::orderBy('created_at', 'DESC')->paginate(12);
        return view('shop', compact('products'));
    }

    public function productDetails($slug) {
        $product = Product::where('slug', $slug)->first();
        $products = Product::where('slug', '!=', $slug)->inRandomOrder('id')->get()->take('8');
        return view('details', compact('product', 'products'));
    }
}
