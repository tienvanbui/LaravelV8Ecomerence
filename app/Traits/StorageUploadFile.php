<?php 
/**
 * 
 */
namespace App\Traits;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
trait StorageUploadFile
{
    public function UploadFile($request,$fieldName,$floderName,$width,$height){
        if ($request->hasFile($fieldName)) {
        $file = $request->file($fieldName);
        $fileName = $file->hashName();
        $fileOriginalName = $file->getClientOriginalName();
        $file->storeAs("public/" . $floderName . "/" . auth()->user()->id, $fileName);
        $image_resize = Image::make($file->getRealPath());
        $image_resize->fit($width, $height);
        $image_resize->save(public_path("storage/$floderName/".auth()->user()->id .'/'.$fileName));
        $dataUpload = [
            'fileName'=> $fileOriginalName,
            'filePath'=>"/storage/$floderName/".auth()->user()->id."/$fileName",
        ];
        return $dataUpload;
        }
         return null;
    }
    public function UploadFileMultiple($file,$floderName){
        $fileName = $file->hashName();
        $fileOriginalName = $file->getClientOriginalName();
        $image_resize = Image::make($file->getRealPath());
        $image_resize->fit(220, 220);
        $image_resize->save(public_path('storage/' . $floderName . '/' . auth()->user()->id . '/' . $fileName));
        $dataUpload = [
            'fileName'=> $fileOriginalName,
            'filePath'
            =>
            "/storage/$floderName/" . auth()->user()->id . "/$fileName",
        ];
        return $dataUpload;       
    }
    public function UploadAvatar($request,$fieldName,$floderName){
       if($request->hasFile($fieldName)){
        $file = $request->$fieldName;
        $fileName = $file->getClientOriginalName();
        if(auth()->user()->avatar){
            Storage::delete('/storage/app/public/avatars/'.auth()->user()->id."/".auth()->user()->avatar);
        }
        $path = $request->file($fieldName)->storeAs("public/".$floderName."/".auth()->user()->id,$fileName); 
        $dataUpload = [
            'filePath'=>Storage::url($path)
        ];
        return $dataUpload;
       }
       return null;
    }
}



?>