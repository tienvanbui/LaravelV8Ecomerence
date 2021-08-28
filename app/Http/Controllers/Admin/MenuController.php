<?php

namespace App\Http\Controllers\Admin;

use App\components\Recusive;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Str;
class MenuController extends Controller
{
    private $menu;
    public function __construct(Menu $menu)
    {
        $this->menu = $menu;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = $this->menu->paginate(3);
        return view('admin.menu.list')->with('menus',$menus);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $menu = Menu::all();
        $recusive = new Recusive($menu);
        $htmlOption = $recusive->menuRecusive($parentID ='');
        return view('admin.menu.create')->with('htmlOption',$htmlOption );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $menus = $this->menu->create([
            'menu_name'=>ucwords($request->menu_name),
            'parent_id'=>$request->parent_id,
            'slug'=>Str::slug($request->menu_name,'-'),

        ]);
        return redirect()->route('menu.index')->with('message','Item menu created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {  
      $menus = Menu::all();
      $recusive = new Recusive($menus);   
      $htmlOption = $recusive->menuRecusive($menu->parent_id);
       return view('admin.menu.edit',[
           'menu'=>$menu,
           'htmlOption'=>$htmlOption
       ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $menu->update([
            'menu_name'=>ucwords($request->menu_name),
            'parent_id'=>$request->parent_id,
            'slug'=>Str::slug($request->menu_name)
        ]);
        return redirect()->route('menu.index')->with('message','Item menu updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
        $menu->menus()->delete();
        return redirect()->route('menu.index')->with('message','Item menu deleted successfully!');
    }
}
