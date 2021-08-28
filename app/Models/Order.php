<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\Size;
use App\Models\Coupon;
class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = ['user_id','payment_id','status','total','address_shipping','phoneNumber_shipping', 'coupon_code','cart_id'];

    public function payment(){
        return $this->belongsTo(Payment::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function products(){
        return $this->belongsToMany(Product::class,'order_product','order_id','product_id')->withPivot('buy_quanlity', 'color_id', 'size_id');
    }
    public function cart(){
        return $this->belongsTo(Cart::class);
    }
    public function itemPurchased($user_id){
        $order = Order::where('user_id', $user_id)->first();
        $cartOfOrder = $order->products()->get();
        return $productInOrder = $cartOfOrder->count();
    }
    public  static function getColorName($item)
    {
        return  $color = Color::where('id', $item->pivot->color_id)->first();
    }
    public  static function getSizeName($item)
    {
        return  $color = Size::where('id', $item->pivot->size_id)->first();
    }
}
