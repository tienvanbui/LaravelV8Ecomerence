<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\Traits\StorageUploadFile;
use App\Models\Tag;

class UserBlogController extends Controller
{   
    use StorageUploadFile;
    private $blog;

    public function __construct(Blog $blog,Tag $tag)
    {
        $this->authorizeResource(Blog::class,'blog');
        $this->blog = $blog;    
        $this->tag= $tag;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::paginate(config('appConst.appConst.PRODUCT_IN_PER_PAGE'));
        $data['tags'] = Tag::all();
         return view('user.blog.blog_list',[
            'tags' => $data['tags'],
            'blogs' => $blogs,
         ]);
    }
}
