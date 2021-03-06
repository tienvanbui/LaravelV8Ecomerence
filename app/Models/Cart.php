<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable = ['user_id'];
    public function products(){
        return $this->belongsToMany(Product::class,'cart_product','cart_id','product_id')->withPivot('buy_quanlity','color_id','size_id');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function order(){
        return $this->hasOne(Order::class);
    }
    
}
