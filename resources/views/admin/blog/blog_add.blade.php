@section('title')
    Create Blog
@endsection
@section('js')
    <script src="https://cdn.tiny.cloud/1/r928fye7qnf2rd5f2rv7qbqs1tsx6kpqtcagu23qrx9syycv/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
     tinymce.init({
        selector: '.mytextarea'
      });
    </script>
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
                <!-- /.col-lg-12 -->
            </div>
	</div>
  <div class="row">
    <div class="col-sm-12">
      <h2 class="text-center mt-3">CREATE BLOG</h2>
        <form method="POST" action="@if (auth()->user()->isAdmin())
          {{route('blog.store')}}
          @else
          {{route('userBlog.store')}}
        @endif" enctype="multipart/form-data" >
            @csrf
          <div class="form-group">
            <label for="blog_name">Title</label>
            <input type="text" class="form-control" id="blog_name" aria-describedby="blog_name" placeholder="Enter Title" name="blog_name">
          </div>
          
          <div class="form-group">
            <label for="thumbnail">Thumbnail Image</label>
            <input type="file" class="form-control" id="thumbnail" name="thumbnail" aria-describedby="thumbnail">
          </div>
          <div class="form-group">
            <label >Tag Blog</label>
            <select class="form-control" multiple="multiple" name="tags[]" style="height:100px">
              @foreach ($tags as $item)
                  <option value="{{$item->id}}">{{$item->tags_name}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Content Blog</label>
            <textarea name="blog_content" class="form-control" rows="20" id="ckeditor_blog_add"></textarea>
          </div>
          <div class="form-group">
            <label for="img_content">Content Image</label>
            <input type="file" class="form-control" id="img_content" name="img_content" aria-describedby="img_content">
          </div>
          <div class="d-grid gap-2">
          <button type="submit" class="btn btn-primary ">Create</button>
          </div>
        </form>
    </div>
  </div>
</div>
@endsection
@include('partials.main')
@include('partials.footer')
