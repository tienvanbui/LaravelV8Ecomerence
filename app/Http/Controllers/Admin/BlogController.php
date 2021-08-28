<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Tag;
use App\Policies\BlogPolicy;
use App\Traits\StorageUploadFile;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BlogController extends Controller
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
        $blogs = $this->blog->paginate(config('appConst.appConst.PRODUCT_IN_PER_PAGE'));
        return view('admin.blog.blog_list')->with('blogs',$blogs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $data['tags']=Tag::all();
        return view('admin.blog.blog_add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->blog->StoreBlog($request);
        return redirect()->route('blog.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        return view('admin.blog.blog_show')->with('blog',$blog);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        $data['tagAll']=Tag::all();
        $data['blog']=$blog;
        $data['BlogHasTag'] = $blog->tags()->get();
        return view('admin.blog.blog_edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $this->blog->UpdateBlog($request,$blog); 
        return redirect()->route('blog.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->tags()->detach();
        $blog->delete();
        return redirect()->route('blog.index');
    }
}
