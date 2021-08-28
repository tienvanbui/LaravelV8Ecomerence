<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoveProduct extends Model
{
    use HasFactory;
    protected $table = 'loves';
    protected $fillable = ['user_id'];
    public function products(){
        return $this->belongsToMany(Product::class,'love_product','love_id','product_id')->withPivot('isLove');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function storeLoveProduct($request)
    {
            $user_id = LoveProduct::where('user_id',auth()->user()->id)->first();
            if($user_id==null){
                $love = new LoveProduct();
                $love->fill(['user_id' => auth()->user()->id]);
                $love->save();
            }
            else{
                $love = LoveProduct::where('user_id', auth()->user()->id)->first();
            }  
            if(!$love->products->contains($request->product_id)){
                    $love->products()->attach(
                    $request->product_id,
                    [
                        'isLove'=>$request->isLove,
                    ]
                    );
            }
    }
    public static function deleteLoveProduct($product_id){
        $love_need_delete = LoveProduct::where('user_id',auth()->user()->id)->first();
        $love_need_delete->products()->detach($product_id);
    }
}
