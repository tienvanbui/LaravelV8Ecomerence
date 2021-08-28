<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Request;
use App\Models\Color;
use Illuminate\Support\Facades\Cache;

class ClientProductController extends Controller
{   
    private $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected function index()
    {   
        $colors = Color::all();
        if(Request::has('price'))
             $products = $this->product->sortByPrice();
        else if(Request::has('sort-by'))
            $products = $this->product->sortBy();
        else if(Request::has('color'))
            $products = $this->product->sortByColor($colors);
        else if(Request::has('banner_name'))
            $products = $this->product->searchByBanner();
        else
            $products = Product::orderBy('Price', 'DESC')->paginate(config('appConst.PRODUCT_IN_PER_PAGE'));
        return view('user.product.list',[
            'products'=>$products,
            'colors'=>$colors,
        ]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    protected function show(Product $product)
    {   
        $data= Cache::rememberForever('productDetail',function() use ($product){
            return $product->whereId($product->id)->with(['productImgs', 'productdetail'])->first();
        });
        $relatedProduct = $this->product->getRelatedProduct($product);
        $dataImg = $data->productImgs;
        return view('user.product.detail',[
            'product'=>$data,
            'productImgs'=>$dataImg,
            'relatedToProducts'=>$relatedProduct,
        ]);
       
    }
    
    // public function qickView(Request $request){
    //     $product_id = $request->product_id;
    //     $product = $this->product->find($product_id);
    //     $product_img_detail = $product->productImgs;
    //     $jsonProduct['img_path'] = '';
    //     foreach($product_img_detail as $value){
    //          $jsonProduct['img_path'] = $value;
    //     }
    //     $jsonProduct['name'] = $product->name;
    //     $jsonProduct['Price'] = $product->Price;
    //     $jsonProduct['seo_product'] = $product->seo_product;
    //     echo json_encode($jsonProduct);
    // }

}
