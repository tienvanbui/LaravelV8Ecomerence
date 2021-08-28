<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $role;
    public function __construct(Role $role)
    {
        $this->role = $role;
    }
    public function index()
    {   
        $role = Role::all();
        return view('admin.role.role_list',[
            'roles'=>$role
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $permission = Permission::where('parent_id',0)->get();
        return view('admin.role.role_add',[
            'permission'=>$permission
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        try {
            DB::beginTransaction();
            $role = $this->role->create([
            'role_name'=>$request->role_name,
            'display_name'=>$request->display_name
            ]);
            $role->permissions()->attach($request->permission_id);
            DB::commit();
            return redirect()->route('role.index');
        } catch (Exception $exception) {
            Log::error("message: ".$exception->getMessage()."--Line:".$exception->getLine());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $permission = Permission::where('parent_id',0)->get();
        $pemissionOfRole = $role->permissions()->get();
        return view('admin.role.role_show',[
            'role'=>$role,
            'pemissionOfRoles'=>$pemissionOfRole,
            'permission'=>$permission,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {   
        $permission = Permission::where('parent_id',0)->get();
        $pemissionOfRole = $role->permissions()->get();
        return view('admin.role.role_edit',[
            'role'=>$role,
            'pemissionOfRoles'=>$pemissionOfRole,
            'permission'=>$permission,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        try {
            DB::beginTransaction();
            $this->role->update([
            'role_name'=>$request->role_name,
            'display_name'=>$request->display_name
            ]);
            $role->permissions()->sync($request->permission_id);
            DB::commit();
            return redirect()->route('role.index');
        }catch (Exception $exception) {
            Log::error("message: ".$exception->getMessage()."--Line:".$exception->getLine());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {   
         try {
            DB::beginTransaction();
            $role->delete();
            DB::commit();
            return redirect()->route('role.index');
        }catch (Exception $exception) {
            Log::error("message: ".$exception->getMessage()."--Line:".$exception->getLine());
        }
      
    }
}
