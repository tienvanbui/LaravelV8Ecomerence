<?php

namespace App\Models;

use App\Traits\StorageUploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
class Slide extends Model
{
    use HasFactory;
    use StorageUploadFile;
    protected $table = 'sliders';
    protected $fillable = [
        'name',
        'des',
        'img_slider',
    ];
    public function Store($request){
        try {
            DB::beginTransaction();
            $datatCreate = [
            'name'=>ucwords($request->name),
            'des'=>ucwords($request->des),
        ];
        $data = $this->UploadFile($request,'img_slider','sliders',1920,930);
        if(!empty($data)){
            $datatCreate['img_slider'] = $data['filePath'];
        }
        $slider  = Slide::create(
            $datatCreate
        );
        DB::commit();
       } catch (Exception $exception) {
           DB::rollBack();
           Log::error("message:".$exception->getMessage());
       }
    }
    public function UpdateSlider($request,$slider){
        try {
            DB::beginTransaction();
            $dataUpdate= [
            'name'=>ucwords($request->name),
            'des'=>ucwords($request->des),
        ];
        $data = $this->UploadFile($request,'img_slider','sliders',1920,930);
        if(!empty($data)){
            $dataUpdate['img_slider'] = $data['filePath'];
        }
        $slider->update(
            $dataUpdate
        );
        DB::commit();
       } catch (Exception $exception) {
           DB::rollBack();
           Log::error("message:".$exception->getMessage());
       }
    }
}
