<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permission.permission_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $permission = Permission::create([
           'permission_name'=>$request->permisionF,
           'display_name'=>$request->permisionF,
           'parent_id'=>0
       ]);
       foreach($request->modulChild as $value){
            Permission::create([
           'permission_name'=>$value." "."$request->permisionF",
           'display_name'=>$value." "."$request->permisionF",
           'parent_id'=>$permission->id,
           'key_code'=>$request->permisionF.'_'.$value,
       ]);
       }
       return redirect()->route('permission.create');
    }
}
