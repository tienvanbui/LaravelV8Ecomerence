@section('title')
    Blogs List
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
                                <li><a href="{{route('blog.index')}}" class="fw-normal">Blogs List</a></li>
                            </ol>
                            <a href="{{route('blog.create')}}"
                                class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Create Blog</a>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
	</div>
  <div class="row">
    <div class="col-sm-12">
      <h2 class="text-center mt-3">BLOGS LIST</h2>
        <table class="table table-hover table-bordered">
        <thead class="table-dark">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Created By</th>
            <th scope="col">Blog Name</th>
            <th scope="col">Thumbnail</th>
            <th scope="col">Time Out</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @php  $id = 0 @endphp
            @foreach ($blogs as $blog)
            @php $id ++ @endphp
            <tr>
            <th scope="row">@php echo $id @endphp</th>
            <td>{{$blog->user->username}}</td>
            <td>{{$blog->blog_name}}</td>
            <td ><img src="{{asset($blog->thumbnail)}}" width="200px" height="200px"></td>
            <td>{{$blog->outdate}}</td>
            <td>
                <a href="
                    {{route('blog.show',['blog'=>$blog->id])}}" class="btn btn-primary btn-sm  text-white " ><i class="fas fa-eye"></i></a>
                <a href="
                    {{route('blog.edit',['blog'=>$blog->id])}}" class="btn btn-success btn-sm text-white " ><i class="fas fa-edit"></i></a>
                @if (auth()->user()->isAdmin())
                @include('partials.delete',[
                    'route'=>'blog.destroy',
                    'item_name'=>'blog',
                    'item'=>$blog
                ])
                @else
                @include('partials.delete',[
                    'route'=>'userBlog.destroy',
                    'item_name'=>'blog',
                    'item'=>$blog
                ])      
                @endif
            </td>
            </tr>
            @endforeach
        </tbody>
        
    </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
            {!! $blogs->links() !!}
            </ul>
        </nav>
    </div>
  </div>
</div>
@endsection
@include('partials.main')
@include('partials.footer')
