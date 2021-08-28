<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\LengthAwarePaginator;

class UserController extends Controller
{   
    private $user;
    private $role;
    public function __construct(User $user,Role $role)
    {

        $this->middleware('auth');
        $this->user = $user;
        $this->role = $role;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data= $this->user->paginate(10);
        return view('admin.users.user_list')->with('users',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $data = $this->role->all();
        return view('admin.users.user_add')->with('roles',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            $user = $this->user->create([
            'name'=>$request->name,
            'username'=>$request->username,
            'email'=>$request->email,
            'phoneNumber'=>$request->phoneNumber,
            'adrress'=>$request->adrress,
            'password'=>Hash::make($request->password),
            'status'=>$request->status,
            'role_id'=>$request->role_id
        ]);
            DB::commit();
            return redirect()->route('manage-user.index');
        }catch(Exception $exception){
            DB::rollback();
            Log::error("Message:".$exception->getMessage().'Line:'.$exception->getLine());
        }

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $manage_user)
    {   
        $roles = $this->role->all();
        $roleOfUser = $manage_user->role()->get();
        return view('admin.users.user_edit',[
            'user'=>$manage_user,
            'roles'=>$roles,
            'roleOfUser'=>$roleOfUser,

        ]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $manage_user)
    {
        try{
            DB::beginTransaction();
            $manage_user->update([
            'name'=>$request->name,
            'username'=>$request->username,
            'email'=>$request->email,
            'phoneNumber'=>$request->phoneNumber,
            'adrress'=>$request->adrress,
            'status'=>$request->status,
            'role_id'=>$request->role_id,
        ]);
        DB::commit();
        return redirect()->route('manage-user.index');
        }catch(Exception $exception){
            DB::rollback();
            Log::error("Message:".$exception->getMessage().'Line:'.$exception->getLine());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $manage_user)
    {
        $manage_user->delete();
        return redirect()->route('manage-user.index');
    }
}
