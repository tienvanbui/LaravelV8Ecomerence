<?php

namespace App\Models;

use App\Traits\StorageUploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use StorageUploadFile;
    use HasFactory;
    protected $guarded = [];
    public function UploadMyProfile($request,$id){
        $data = $this->UploadAvatar($request,'avatar','avatars');
        if(!empty($data)){
            $dataProductUpdate['avatar'] = $data['filePath'];
        }
        
        User::find($id)->update([
            'name'=>$request->name,
            'username'=>$request->username,
            'email'=>$request->email,
            'avatar'=>$dataProductUpdate['avatar'],
        ]);
    }
}
