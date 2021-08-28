@section('title')
    Banner
@endsection
@include('partials.header')
@include('partials.slidebar')
@section('main-content')
<div class="container">
	<div class="row">            
		<div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Banner</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <li><a href="{{route('banner.index')}}" class="fw-normal">Banner</a></li>
                            </ol>
                            <a href="{{route('banner.create')}}"
                                class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Create Banner</a>
                        </div>
                    </div>
                </div>
            </div>
	</div>
	<div class="row">
        <div class="container">
            <h1 class="text-center">EDIT BANNER INFOR</h1>
        <form method="POST" action="{{ route('banner.update',['banner'=>$banner]) }}" enctype="multipart/form-data">
          @csrf
          @method('put')
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" aria-describedby="title" name="title" value="{{$banner->title}}">
          </div>
          <div class="form-group">
            <label for="thumb">Image</label>
            <input type="file" class="form-control-file" id="thumb" aria-describedby="thumb" name="thumb">
            <p class="18rem"><img src="{{asset($banner->thumb)}}"></p>
          </div>
          <div class="form-group">
            <label for="content">Description</label>
            <textarea name="content" cols="30" rows="5" class="form-control" id="ckeditor_banner_edit">{{$banner->content}}</textarea>
          </div>
          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary ">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
@include('partials.main')
@include('partials.footer')
