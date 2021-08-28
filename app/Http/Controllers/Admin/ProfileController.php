<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use App\Traits\StorageUploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
class ProfileController extends Controller
{
    use StorageUploadFile;
    private $profile;
    public function __construct(Profile $profile)
    {
        $this->profile = $profile;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        return view('admin.profile.profile_detail');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {   
        $this->profile->UploadMyProfile($request,$id);
        return redirect()->route('profile.index');
    }

}
