<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailCart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable = [
        'cart_id',
        'user_id',
        'product_id',
        'buy_quanlity',
    ];
    public function cart(){

    }
}
