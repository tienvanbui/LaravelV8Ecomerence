<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
class Coupon extends Model
{
    use HasFactory;
    protected $fillable = ['coupon_code','coupon_codition','coupon_use_number','coupon_used_count','coupon_price_discount'];
}
