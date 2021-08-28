<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\StorageUploadFile;
use App\Models\Profile;

class UserProfile extends Controller
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
        return redirect()->route('userProfile.index');
    }
}
