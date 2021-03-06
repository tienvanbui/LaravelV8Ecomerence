<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments';
    protected $fillable = ['payment method'];
    public function order(){
        return $this->hasOne(Order::class);
    }
}
