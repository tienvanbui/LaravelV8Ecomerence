<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\User\UserProfile;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Client\BlogController as ClientBlogController;
use App\Http\Controllers\Client\ClientProductController;
use App\Http\Controllers\User\LoveProductController;
use App\Http\Controllers\User\UserAboutController;
use App\Http\Controllers\User\UserBlogController;
use App\Http\Controllers\User\UserCartController;
use App\Http\Controllers\User\UserContactController;
use App\Http\Controllers\User\UserOrderController;
use App\Http\Controllers\User\UserProductController;
use App\Http\Controllers\WishListController;
use App\Models\LoveProduct;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//admin Dashboard
Route::group(['prefix'=>'/Admin','middleware'=>['auth','role:admin']], function(){
    //admin---------dashboard
    Route::resource('/dashboard',AdminController::class)->only('index');
    //admin---------category
    Route::resource('/category',CategoryController::class);
    //admin---------product
    Route::resource('/product', ProductController::class);
    // admin---------users
    Route::resource('/manage-user', UserController::class)->except('show');
    // admin ---------role
    Route::resource('/role', RoleController::class);
    // admin---------profile
    Route::resource('/profile', ProfileController::class)->only('index','update');
    // admin---------profile
    Route::resource('/permission', PermissionController::class)->only('index','create','store',);
    // admin---------profile
    Route::resource('/blog', BlogController::class);
    // admin---------profile
    Route::resource('/tag', TagController::class)->except('show');
    // admin--------menu
    Route::resource('/menu',MenuController::class)->except('show');
    // admin--------slide
    Route::resource('/slide',SlideController::class);
    // admin--------color
    Route::resource('/color',ColorController::class)->except('show');
    // admin--------size
    Route::resource('/size',SizeController::class)->except('show');
    // admin--------order
    Route::resource('/order', OrderController::class)->except('edit','update')->names('ordercheck');
    Route::post('/confirm-order/{order}',[OrderController::class, 'update_status_order'])->name('order.confirm-order');
    // admin---------coupon
    Route::resource('/coupon',CouponController::class)->except('show')->names('coupon');
    // admin---------contact
    Route::resource('/contact', ContactController::class)->except('show');
    // admin---------about
    Route::resource('/about', AboutController::class)->except('show');
    // admin---------banner 
    Route::resource('/banner',BannerController::class)->except('show');
    
});
Auth::routes();
// <!===============================================================================================!>
//User Dashboard
Route::group(['prefix'=>'/User','middleware'=>['auth','CheckBlocked','role:user']],function(){
        Route::resource('/MyAccount', AdminController::class);
        // user------------- blog
        Route::resource('/blog', UserBlogController::class)->except('destroy','show','update','create','edit')->names('userBlog');
         // user------------- profile
        Route::resource('/profile', UserProfile::class)->only('index','update')->names('userProfile');
        // user--------------product
        Route::resource('/product',UserProductController::class)->names('user.shop');
        Route::get('/product/category-product/product-for-{slug}', [UserProductController::class, 'showProductByCategoryItem'])->name('user.shop.showByCategory');
        // user--------------cart
        Route::post('/save-to-cart/',[UserCartController::class,'store'])->name('save-cart');
        Route::delete('/delete-form-cart/{id}',[UserCartController::class,'deleteFromCart'])->name('cart.delete');
        Route::put('/update-cart/{id}',[UserCartController::class,'updateCart'])->name('cart.update');
        //   this route is use 
        Route::get('/cofirm-payment/',[UserCartController::class,'confirmPayment'])->name('payment.confirm');
        // route serve for order
        Route::get('/view-cart',[UserCartController::class,'viewCart'])->name('view-cart');
        Route::post('/save-order/',[UserOrderController::class,'storeOrder'])->name('order.store');
        Route::post('/check-coupon/',[CouponController::class,'check_coupon'])->name('checkCoupon');
        Route::post('/product/store-love-product', [LoveProductController::class, 'storeLovedProdut'])->name('loveduser');
        Route::get('/product/view-wishlist',[WishListController::class, 'viewWishList'])->name('view-wishlist');
        Route::delete('product/view-wishlist/remove-product-from-wishlist/{id}',[WishListController::class, 'removeFromWishList'])->name('remove-from-wishlist');
        // user-------------------contact
        Route::get('/contact/', [UserContactController::class, 'contact_view'])->name('contact-view');
        Route::get('/contact/send-mail',[UserContactController::class,'sendMailContact'])->name('mail-contact');
        // user--------------about
        Route::get('/about',[UserAboutController::class, 'about_view'])->name('user-view-about-infor');
});
// <!===============================================================================================!>
//Client
Route::group(['prefix'=>'/home'],function(){
    //blog page
    Route::get('/',[HomeController::class,'index'])->name('home');
    Route::get('/blog',[ClientBlogController::class,'index'])->name('list-blog');
    Route::get('/{tag}/blog/',[ClientBlogController::class,'getBlogWithTag'])->name('selectBlogByTag');
    Route::get('/blog/blog_detail/{blog}',[ClientBlogController::class,'show'])->name('detail-blog');
    // product client
    Route::resource('/product',ClientProductController::class)->names('shop');
    // Route::get('/product/product-for-{slug}',[ClientProductController::class, 'showProductByCategoryItemInMenu'])->name('shop.client.showByCategory');
    // about page
    Route::get('/about', [UserAboutController::class, 'about_view'])->name('client-view-about-infor');
    // contact client page
    Route::get('/contact/', [UserContactController::class, 'contact_view'])->name('client-contact-view');
});

Route::get('login/facebook', [SocialController::class,'redrectFacebook'])->name('redrectFacebook');
Route::get('/callback', [SocialController::class,'processFacebookLogin'])->name('processFacebookLogin');



