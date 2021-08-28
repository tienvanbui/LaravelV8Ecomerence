<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
class Color extends Model
{
    use HasFactory;
    protected $fillable = ['color_name'];
    public function products(){
        return $this->belongsToMany(product::class,'color_product','color_id','product_id');
    }
}
