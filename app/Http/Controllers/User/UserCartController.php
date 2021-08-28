<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Menu;
use App\Models\Payment;
use Illuminate\Contracts\Session\Session;

class UserCartController extends Controller
{
    private $cart;
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
        $this->middleware('auth');
    }
    // this function for storing product to cart
    public function store(Request $request){
        try {
        DB::beginTransaction();
        if(($this->cart->where('user_id',auth()->user()->id)->first())==null){
            $cart = $this->cart->fill(['user_id' => auth()->user()->id]);
            $cart->save();
        }
        $cart = $this->cart->where('user_id', auth()->user()->id)->first();
        $cart->products()->attach(
           $request->product_id,
           [
               'buy_quanlity'=>$request->buy_quanlity,
               'color_id'=>$request->color_id,
               'size_id'=>$request->color_id,
           ]
        );
        DB::commit();
        return redirect()->route('view-cart');
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('message: ' . $exception->getMessage());
        }
    }
    public function viewCart(){
            $idOfUser = auth()->user()->id;
            $cartOfUser = Cart::where('user_id',$idOfUser)->first();
            $countItem  =  $this->countItemCart($cartOfUser);
            session(['cart'=>$cartOfUser,'cartCount'=>$countItem]);
             return view('user.carts.list',[
               'cart'=>$cartOfUser,
           ]);
    }
    public function deleteFromCart($id){
        $idOfUser = auth()->user()->id;
        $cartOfUser = Cart::where('user_id',$idOfUser)->first();
        $cartOfUser->products()->detach($id);
         return redirect()->route('view-cart');
    }
    public function updateCart(Request $request,$id){
        try {
        DB::beginTransaction();
        $cart = Cart::where('id',$request->cart_id)->first();
        $const_color_size = DB::table('carts')->join('cart_product','carts.id','=','cart_product.cart_id')->select('cart_product.color_id', 'cart_product.size_id')->first();
        $cart->products()->detach($id);
        $cart->products()->attach(
           $request->product_id,
           [
               'buy_quanlity'=>$request->buy_quanlity,
               'color_id'=> $const_color_size->color_id,
               'size_id'=> $const_color_size->size_id,
           ]
        );
        session()->flash('notification','updated product successfully!');
        DB::commit();
        return redirect()->route('view-cart');
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('message: ' . $exception->getMessage());
        }
    }
    public function confirmPayment(){
        $coupon_code = session()->get('coupon_code');
        $menu = Menu::where('parent_id',0)->get();
        $idOfUser = auth()->user()->id;
        $cartOfUser = Cart::where('user_id',$idOfUser)->first();
        $payment = Payment::all();
         return view('user.payment.create',[
           'coupon_code'=>$coupon_code,
           'menuParents'=>$menu,
           'cart'=>$cartOfUser,
           'payments'=>$payment,
       ]);
    }
    public function countItemCart($cart){
        return (!empty($cart->products))? $cart->products()->count() : 0;
    }
    
}
