<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Client\ClientProductController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use App\Models\Category;
use App\Models\Color;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
class UserProductController extends Controller
{    private $product;
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
        if (Request::has('price'))
            $products = $this->product->sortByPrice();
        else if (Request::has('sort-by'))
            $products = $this->product->sortBy();
        else if (Request::has('color'))
            $products = $this->product->sortByColor($colors);
        else if (Request::has('banner_name'))
            $products = $this->product->searchByBanner();
        else
            $products = Product::orderBy('Price', 'DESC')->paginate(config('appConst.PRODUCT_IN_PER_PAGE'));
        return view('user.product.list', [
            'products' => $products,
            'colors' => $colors,
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
        $data = Cache::rememberForever('productDetail', function () use ($product) {
            return $product->whereId($product->id)->with(['productImgs', 'productdetail'])->first();
        });
        $relatedProduct = $this->product->getRelatedProduct($product);
        $dataImg = $data->productImgs;
        return view('user.product.detail', [
            'product' => $data,
            'productImgs' => $dataImg,
            'relatedToProducts' => $relatedProduct,
        ]);
    }
    public function showProductByCategoryItem($slug)
    {
        $colors = Color::all();
        $categorySlug  = Category::where('name',ucwords($slug))->first();
        $products = $categorySlug->products()->latest()->paginate(config('appConst.appConst.PRODUCT_IN_PER_PAGE'));
        $url_path = Request::url();
        $categoryName = substr($url_path, strpos($url_path, $slug), strlen($url_path));
        return view('user.product.list', [
            'products' => $products,
            'colors' => $colors,
            'title'=>$categoryName,
        ]); 
       
    }
}