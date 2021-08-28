<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoveProduct;
class LoveProductController extends Controller
{
    private $loveProduct;
    public function __construct(LoveProduct $loveProduct)
    {
        $this->loveProduct = $loveProduct;
    }
    public function storeLovedProdut(Request $request){
        $this->loveProduct->storeLoveProduct($request);
        return redirect()->route('view-wishlist');
    }
    
}
