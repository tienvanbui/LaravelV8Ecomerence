<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $data['category']= Category::all();
        return view('admin.category.category_list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin.category.category_add');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $categories = new Category();
        $categories->fill($request->all());
        $categories->save();
        return redirect()->route('category.index')->with('message','Category created successfully
        !');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category){   
        return view('admin.category.category_edit')->with('category',$category);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Category $category){   
       $category->update($request->all());
       return redirect()->route('category.index')->with('message','Category updated successfully
        !');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category){  
       $category->delete();
       return redirect()->route('category.index');
    }
    public function deleteCategory(Category $category){
        return view('admin.category.category_delete',[
            'category'=>$category
        ])->with('message','Category deleted successfully
        !');
    }
}
