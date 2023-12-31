<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller {
    public function index() {
        $cartItems = Cart::instance('cart')->content();
        // print_r($cartItems);
        return view('cart', ['cartItems' => $cartItems]);
    }

    // add to cart
    public function addToCart(Request $request) {
        $product = Product::find($request->id);
        $price = $product->sale_price ? $product->sale_price : $product->regular_price;
        Cart::instance('cart')->add($product->id, $product->name, $request->quantity, $price)->associate('App\Models\Product');
        return redirect()->back()->with('message', 'Success | Item has been added successfully');
    }

    // update cart
    public function updateCart(Request $request) {
        Cart::instance('cart')->update($request->rowId, $request->quantity);
        return redirect()->route('cart.index');
    }

    // remove item cart
    public function removeItem(Request $request) {
        $rowId = $request->rowId;
        Cart::instance('cart')->remove($rowId);
        return redirect()->route('cart.index');
    }

    // clear cart
    public function clearCart() {
        Cart::instance('cart')->destroy();
        return redirect()->route('cart.index');
    }
}
