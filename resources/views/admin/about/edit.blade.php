@section('title')
  Edit About
@endsection
@include('partials.header')
@include('partials.slidebar')
@section('main-content')
  <div class="container">
    <div class="row">
      <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">About</h4>
          </div>
          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <div class="d-md-flex">
              <ol class="breadcrumb ms-auto">
                <li><a href="{{ route('about.index') }}" class="fw-normal">About Infor</a></li>
              </ol>
              <a href="{{ route('about.create') }}"
                class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Create
                About</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <h2 class="text-center mt-3">EDIT ABOUT INFOR</h2>
        <form method="POST" action="{{ route('about.update',['about'=>$about]) }}" enctype="multipart/form-data">
          @csrf
          @method('put')
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" aria-describedby="title" name="title" value="{{$about->title}}">
          </div>
          <div class="form-group">
            <label for="thumbnail">Image</label>
            <input type="file" class="form-control-file" id="thumbnail" aria-describedby="thumbnail" name="thumbnail">
            <p class="18rem"><img src="{{asset($about->thumbnail)}}"></p>
          </div>
          <div class="form-group">
            <label for="des">Description</label>
            <textarea name="des" cols="30" rows="10" id="ckeditor_about_edit" class="form-control">{{$about->des}}</textarea>
          </div>
          <div class="form-group">
            <label for="quote">Quote</label>
            <textarea name="quote" cols="30" rows="5" class="form-control" id="ckeditor_about_quote_edit">{{$about->quote}}</textarea>
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
