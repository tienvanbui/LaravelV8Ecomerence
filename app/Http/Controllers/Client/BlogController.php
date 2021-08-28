<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Carbon;
use App\Models\Tag;
use App\Support\Collection;

class BlogController extends Controller
{
    private $blog;
    public function __construct(Blog $blog)
    {
        $this->blog = $blog;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user =User::where('status',0)->get();
        foreach($user as $item){
            foreach($item->blogs as $blog){
                if((Carbon::now('Asia/Ho_Chi_Minh'))->lessThanOrEqualTo(Carbon::parse($blog->outdate)->timezone('Asia/Ho_Chi_Minh'))){
                   $data['blogsArray'][][]= $blog;
                }      
            }
        }

        $blogs = (new Collection($data['blogsArray']))->paginate(config('appConst.appConst.PRODUCT_IN_PER_PAGE'));
        $data['tags'] = Tag::all();
        return view('user.blog.blog_list',[
            'tags'=>$data['tags'],
            'blogs'=>$blogs,
        ]);
        
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {   
        $data['blog'] = $blog;
        $data['tags'] = Tag::all();
        return view('user.blog.detail',$data);
    }
    public function getBlogWithTag(Tag $tag){
       $blogs = (new Collection($this->blog->ShowBlogByTag($tag)))->paginate(1);
       $data['tags'] = Tag::all();
       return view('user.blog.blog_bytag',[
            'tags'=>$data['tags'],
            'blogs'=>$blogs,
        ]);
    }

}