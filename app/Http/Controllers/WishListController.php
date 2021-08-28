<?php

namespace App\Http\Controllers;

use App\Models\LoveProduct;
use Illuminate\Http\Request;

class WishListController extends Controller
{
    public function viewWishList(){
        $lovedProduct = LoveProduct::where('user_id',auth()->user()->id)->first();
        $product_in_wishlist_of_this_user = $lovedProduct->products;
        return view('user.wishlist.list')->with('wishlistProducts',$product_in_wishlist_of_this_user);   
    }
    public function removeFromWishList($id)
    {
        LoveProduct::deleteLoveProduct($id);
        return redirect()->route('view-wishlist');   
    }


}
