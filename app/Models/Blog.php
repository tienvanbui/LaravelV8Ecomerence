<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryBlog;
use App\Models\Tag;
use App\Models\User;
use App\Traits\StorageUploadFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use phpDocumentor\Reflection\Types\This;
use Illuminate\Support\Carbon;
class Blog extends Model
{

    use HasFactory;
    use StorageUploadFile;
    protected $guarded = [];
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
      
    public function StoreBlog($request){
        try {
            DB::beginTransaction();
            $dataBlog = [
                'blog_name'=>$request->blog_name,
                'blog_content'=>$request->blog_content,
                'user_id'=>auth()->user()->id,
                'outdate'=>Carbon::now()->addMonth(1),
            ];
            $dataImg = $this->UploadFile($request,'thumbnail','blog',720,720);
            $dataImgContent = $this->UploadFile($request,'img_content','imageContentBlog', 720, 720);
            if(!empty($dataImg)){
                $dataBlog['thumbnail'] = $dataImg['filePath'];
            }
            if(!empty($dataImgContent)){
                $dataBlog['img_content'] = $dataImgContent['filePath'];
            }
            $blogAdd = Blog::create($dataBlog);
            $blogAdd->tags()->attach($request->tags);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error("message:" .$exception->getMessage());
        }
    }
    public function UpdateBlog($request,$blog){
        try {
            DB::beginTransaction();
            $dataBlogUpdate = [
                'blog_name'=>$request->blog_name,
                'blog_content'=>$request->blog_content,
                'user_id'=>auth()->user()->id,
                'outdate'=>Carbon::now()->addMonth(1),
            ];
            $dataImg = $this->UploadFile($request,'thumbnail','blog',720,720);
            $dataImgContent = $this->UploadFile($request,'img_content','imageContentBlog',720,720);
            if(!empty($dataImg)){
                $dataBlogUpdate['thumbnail'] = $dataImg['filePath'];
            }
            if(!empty($dataImgContent)){
                $dataBlogUpdate['img_content'] = $dataImgContent['filePath'];
            }
            $blog->update($dataBlogUpdate);
            $blog->tags()->sync($request->tags);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error("message:" .$exception->getMessage());
        }
    }
    public function ShowBlogByTag($tag){
      return  $BlogsByTag=$tag->blogs()->get();
    }
    
}
