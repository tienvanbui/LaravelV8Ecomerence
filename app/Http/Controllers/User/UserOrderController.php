<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
class UserOrderController extends Controller
{
    private $order;
    private $totalMoneyPlusTax;
    public function __construct(Order $order,Cart $cart)
    {
        $this->order = $order;
    }
    public function storeOrder(Request $request){
       try {
            if ($request->payment_id == 1) {
                $this->totalMoneyPlusTax = ($request->total  + ($request->total * 0.03));
            }
            $this->totalMoneyPlusTax = ($request->total  - ($request->total * 0.01) );
            $dataOrder = [
                'user_id' => auth()->user()->id,
                'payment_id' => $request->payment_id,
                'total' => $this->totalMoneyPlusTax,
                'address_shipping' => $request->address,
                'phoneNumber_shipping' => $request->phoneNumber,
                'coupon_code' => $request->coupons_code,
            ];
            $order = $this->order->fill($dataOrder);
            $order->save();
             $cart_order = DB::table('orders')->join('carts','orders.user_id','=','carts.user_id')->join('cart_product', 'cart_product.cart_id','=','carts.id')->select('cart_product.product_id','cart_product.buy_quanlity', 'cart_product.color_id', 'cart_product.size_id')->get();
            foreach ($cart_order as $value) {
                $order_product['order_id'] = $order->id;
                $order_product['product_id'] = $value->product_id;
                $order_product['buy_quanlity'] = $value->buy_quanlity;
                $order_product['color_id'] = $value->color_id;
                $order_product['size_id'] = $value->size_id;
                DB::table('order_product')->insert($order_product);
            }
            DB::table('carts')->where('user_id',$order->user_id)->delete();
            return redirect()->route('view-cart')->with('messageSuccess', 'Thank you for your support. You will receive your product as quickly as possible!');
       } catch (Exception $exception) {
           DB::rollBack();
       }

    }
   
}
