@section('title')
     Detail Blog
@endsection
@include('partials.header')
@include('partials.slidebar')
@section('main-content')
<div class="container">
	<div class="row">            
		<div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Blog</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <li><a href="@if (auth()->user()->isAdmin())
                                    {{route('blog.index')}}
                                    @else
                                    {{route('userBlog.index')}}
                                    @endif" class="fw-normal">Blogs List</a></li>
                            </ol>
                                    <a href="@if (auth()->user()->isAdmin())
                                    {{route('blog.create')}}
                                    @else
                                    {{route('userBlog.create')}}
                                    @endif"
                                class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Create Blog</a>
                        </div>
                    </div>
                </div>
            </div>
	</div>
  <div class="row">
    <div class="col-sm-12">
        <table class="table table-hover table-bordered">
        <thead class="table-dark">
            <tr>
            <th scope="col">Content</th> 
            <th scope="col">Image Content</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <td>{!!$blog->blog_content!!}</td>
            <td ><img src="{{asset($blog->img_content)}}" width="200px" height="200px"></td>
            </tr>
        </tbody>
    </table>
    </div>
  </div>
</div>
@endsection
@include('partials.main')
@include('partials.footer')
