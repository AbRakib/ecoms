<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class WishlistController extends Controller {

    // get wishlist
    public function getWishlistedProducts() {
        $items = Cart::instance("wishlist")->content();
        return view('wishlist', compact('items'));
    }

    // add wishlist
    public function addProductToWishlist(Request $request) {
        Cart::instance("wishlist")->add($request->id, $request->name, 1, $request->price)->associate('App\Models\Product');
        return response()->json(['status' => 200, 'message' => 'Success ! item successfully add your wishlist']);
    }

    // remove product from wishlist
    public function removeProductFromWishlist(Request $request) {
        $rowId = $request->rowId;
        Cart::instance("wishlist")->remove($rowId);
        return redirect()->route("wishlist.list");
    }

    // clear wishlist
    public function clearWishlist() {
        Cart::instance("wishlist")->destroy();
        return redirect()->route("wishlist.list");
    }
}
