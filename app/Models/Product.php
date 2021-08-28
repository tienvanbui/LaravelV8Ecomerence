<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductImg;
use App\Models\ProductDetail;
use App\Models\User;
use App\Traits\StorageUploadFile;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Color;
use App\Models\Size;
use App\Support\Collection;
use Intervention\Image\ImageManagerStatic as Image;
class Product extends Model
{
    use HasFactory;
    use StorageUploadFile;
    protected $guarded = [];
    public function orders(){
        return $this->belongsToMany(Order::class,'order_product','product_id','order_id')->withPivot('buy_quanlity','color_id','size_id');
    }
    public function loves(){
        return $this->belongsToMany(LoveProduct::class,'love_product','product_id','love_id')->withPivot('isLove');
    }
    public function productImgs(){
        return $this->hasMany(ProductImg::class);
    }
    public function productdetail(){
        return $this->hasOne(ProductDetail::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function carts(){
        return $this->belongsToMany(Cart::class,'cart_product','product_id','cart_id');
    }
    public function colors(){
        return $this->belongsToMany(Color::class,'color_product','product_id','color_id');
    }
    public function sizes(){
        return $this->belongsToMany(Size::class,'size_product','product_id','size_id');
    }
    public function StoreProduct($request){
        try {
            DB::beginTransaction();
            $dataProductCreate = [
            'name'=>ucwords($request->name),
            'Price'=>$request->Price,
            'category_id'=>$request->category_id,
            'seo_product'=>ucwords($request->seo_product),
            'user_id'=>auth()->user()->id,
            'is_love'=>$request->is_love
        ];
            $data = $this->UploadFile($request,'feature_img','products',220,220);
        if(!empty($data)){
            $dataProductCreate['feature_img_name'] = $data['fileName'];
            $dataProductCreate['feature_img'] = $data['filePath'];
        }
        $product  = Product::create(
            $dataProductCreate
        );
        //insert product images
        if($request->hasfile('img_path')){
            foreach($request->file('img_path') as $item){
                $dataProductImages = $this->UploadFileMultiple($item,'products');
                $product->productImgs()->create([
                    'img_path_name'=>$dataProductImages['fileName'],
                    'img_path'=>$dataProductImages['filePath']
                ]);
            }
        }
        //insert product detail
        $product->productdetail()->create(
            [
            'des'=>ucwords($request->des),
            'weight'=>$request->weight,
            'dimension'=>$request->dimension,
            ]
        );
        $product->colors()->attach($request->color_id);
        $product->sizes()->attach($request->size_id);
        DB::commit();
       } catch (Exception $exception) {
           DB::rollBack();
           Log::error("message:".$exception->getMessage());
       }
    }
    public function UpdateProduct($request,$product){
        try {
            DB::beginTransaction();
           $dataProductUpdate = [
            'name'=>ucwords($request->name),
            'Price'=>$request->Price,
            'category_id'=>$request->category_id,
            'seo_product'=>ucwords($request->seo_product),
            'user_id'=>auth()->user()->id,
            'is_love'=>$request->is_love
        ];
        $data = $this->UploadFile($request,'feature_img','products',220,220);
        if(!empty($data)){
            $dataProductUpdate['feature_img_name'] = $data['fileName'];
            $dataProductUpdate['feature_img'] = $data['filePath'];
        }
        $product->update(
            $dataProductUpdate
        );
        //insert product images
        if($request->hasfile('img_path')){
            $product->productImgs()->delete();
            foreach($request->file('img_path') as $item){
                $dataProductImages = $this->UploadFileMultiple($item,'products');
                $product->productImgs()->create([
                    'img_path_name'=>$dataProductImages['fileName'],
                    'img_path'=>$dataProductImages['filePath']
                ]);
            }
        }
        // insert product detail
        $product->productdetail()->update(
            [
            'des'=>ucwords($request->des),
            'weight'=>$request->weight,
            'dimension'=>$request->dimension,
            ]
        );
            $product->colors()->sync($request->color_id);
            $product->sizes()->sync($request->size_id);
        DB::commit();
        } catch (Exception $exception) {
            DB::transaction();
           Log::error("message:".$exception->getMessage());
        }
    }
    public function getRelatedProduct($product){
        $categoryId = $product->category_id;
        return Product::where('category_id',$categoryId)->whereNotIn('id',[$product->id])->latest()->take(10)->get();
    }
    //sort product 
    public function sortBy(){
        if (isset($_GET['sort-by'])){
            $sort_by = $_GET['sort-by'];
            if ($sort_by == 'default')
                return  Product::latest()->paginate(config('appConst.PRODUCT_IN_PER_PAGE'));
            else if ($sort_by == 'price-from-low-to-high')
                return Product::orderBy('Price', 'ASC')->paginate(config('appConst.PRODUCT_IN_PER_PAGE'));
            else if ($sort_by == 'price-from-high-to-low')
                return Product::orderBy('Price', 'DESC')->paginate(config('appConst.PRODUCT_IN_PER_PAGE'));
            }
    }
    public function sortByPrice(){
        if (isset($_GET['price'])){
            $price = $_GET['price'];
            if ($price == 'all')
                return $products = Product::latest()->paginate(config('appConst.PRODUCT_IN_PER_PAGE'));
            else if ($price == 'from-0-to-50')
                return $products = Product::whereBetween('Price', [0, 50])->paginate(config('appConst.PRODUCT_IN_PER_PAGE'));
            else if ($price == 'from-50-to-100')
                return $products = Product::whereBetween('Price', [50, 100])->paginate(config('appConst.PRODUCT_IN_PER_PAGE'));
            else if ($price == 'from-100-to-150')
                return $products = Product::whereBetween('Price', [101, 150])->paginate(config('appConst.PRODUCT_IN_PER_PAGE'));
            else if ($price == 'from-150-to-200')
                return $products = Product::whereBetween('Price', [150, 200])->paginate(config('appConst.PRODUCT_IN_PER_PAGE'));
            else if ($price == '200plus')
                return  $products = Product::where('Price', '>', 200)->paginate(config('appConst.PRODUCT_IN_PER_PAGE')); 
        }
    }
    public function sortByColor($colors){
        if(isset($_GET['color'])){
            $color = $_GET['color'];
            foreach($colors as $colorItem){
                if($color == $colorItem->color_name){
                    return $colorItem->products()->latest()->paginate(config('appConst.PRODUCT_IN_PER_PAGE'));
                    break;
                }
            }
        }
    }
    public function searchProduct($search_infor){
        return Product::where('name','like',"%$search_infor%")->latest()->paginate(config('appConst.PRODUCT_IN_PER_PAGE'));
    }
    public function searchByBanner(){
        if(isset($_GET['banner_name'])){
            $banner_name = $_GET['banner_name'];
            $category = Category::where('name', $banner_name)->first();
            return $products = $category->products()->paginate(config('appConst.appConst.PRODUCT_IN_PER_PAGE'));
        }
    }
}
