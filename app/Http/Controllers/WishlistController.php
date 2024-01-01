<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class WishlistController extends Controller {

    // add wishlist
    public function addProductToWishlist(Request $request) {
        Cart::instance("wishlist")->add($request->id, $request->name, 1, $request->price)->associate('App\Models\Product');
        return response()->json(['status' => 200, 'message' => 'Success ! item successfully add your wishlist']);
    }

    //
}
