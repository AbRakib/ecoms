<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller {

    public function index(Request $request) {
        $page = $request->query("page");
        $size = $request->query("size");
        $order = $request->query("order");
        if(!$page)
        $page = 1;
        if(!$size)
        $size = 12;
        if(!$order)
        $order = -1;
        $o_column = "";
        $o_order = "";
        switch ($order) {
            case '1':
                $o_column = "created_at";
                $o_order = "DESC";
                break;
            case '2':
                $o_column = "created_at";
                $o_order = "ASC";
                break;
            case '3':
                $o_column = "regular_price";
                $o_order = "ASC";
                break;
            case '4':
                $o_column = "regular_price";
                $o_order = "DESC";
                break;
            default:
                $o_column = "id";
                $o_order = "DESC";
                break;
        }
        $products = Product::orderBy('created_at', 'DESC')->orderBy($o_column, $o_order)->paginate($size);
        return view('shop', compact('products', 'page', 'size', 'order'));
    }

    public function productDetails($slug) {
        $product = Product::where('slug', $slug)->first();
        $products = Product::where('slug', '!=', $slug)->inRandomOrder('id')->get()->take('8');
        return view('details', compact('product', 'products'));
    }
}
