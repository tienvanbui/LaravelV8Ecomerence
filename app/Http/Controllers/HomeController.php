<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Color;
use App\Models\LoveProduct;
use App\Models\Menu;
use App\Models\Product;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use phpDocumentor\Reflection\Types\This;
use Symfony\Component\HttpFoundation\Session\Session;
class HomeController extends Controller
{   
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $slidersInfor = Slide::latest()->limit(3)->get();
        $menu = Menu::where('parent_id',0)->get();
        $colors = Color::all();
        $products = $this->product->latest()->paginate(config('appConst.appConst.PRODUCT_IN_PER_PAGE'));
        session(['menuParents'=>$menu]);
        $banners = Banner::latest()->get();
        return view('home',[
            'sliders'=>$slidersInfor,
            'colors'=>$colors,
            'products'=>$products,
            'banners'=>$banners,
        ]);
    }
    
}
