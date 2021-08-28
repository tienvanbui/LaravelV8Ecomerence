<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Traits\StorageUploadFile;
use App\Http\Requests\StorageProductRule;
use Illuminate\Support\Facades\Log;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\This;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use StorageUploadFile;
    private $product;
    private $category;
    public function __construct(Product $product,Category $category)
    {   
        $this->authorizeResource(Product::class, 'product');
        $this->product =  $product;
        $this->category =  $category;
    }
    public function index()
    {
        $data = Product::paginate(10);
        return view('admin.product.product_list')->with('products',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $data['category']= $this->category->all();
        $data['color']= Color::all();
        $data['size']= Size::all();
        return view('admin.product.product_add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorageProductRule $request)
    {   
     $this->product->StoreProduct($request);
       return redirect()->route('product.index')->with('message','Product created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {   
        $IdOfthisProduct = $product->id;
        $data = $product->whereId($IdOfthisProduct)->with(['productImgs','productdetail'])->first();
        return view('admin.product.product_show')->with('product',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product,Category $category)
    {   
        $IdOfthisProduct = $product->id;
        $data['category'] = $category->all();
        $data['color']= Color::all();
        $data['size']= Size::all();
        $data['productHasColor'] = $product->colors()->get();
        $data['productHasSize'] = $product->sizes()->get();
        $data['product']=$product->whereId($IdOfthisProduct)->with(['productImgs','productdetail'])->first();
        return view('admin.product.product_edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorageProductRule $request, Product $product)
    {
        $this->product->UpdateProduct($request,$product);
        return redirect()->route('product.index')->with('message','Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
          $product->delete();
          return redirect()->route('product.index')->with('message','Delete Product Successfully!');
    }
    public function delete(Product $product){
          return view('admin.product.product_delete')->with('product',$product);
    }
}
