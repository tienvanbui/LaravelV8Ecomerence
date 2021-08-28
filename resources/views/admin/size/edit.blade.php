@section('title')
    Create Size
@endsection
@include('partials.header')
@include('partials.slidebar')
@section('main-content')
<div class="container">
	<div class="row">            
		<div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Size</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <li><a href="{{route('size.index')}}" class="fw-normal">Sizes List</a></li>
                            </ol>
                            <a href="{{route('size.create')}}"
                                class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Create Size</a>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
	</div>
  <div class="row">
    <div class="col-sm-12">
      <h2 class="text-center mt-3">Create Size</h2>
<form method="POST" action="{{route('size.update',['size'=>$size])}}" >
    @csrf
    @method('put')
  <div class="form-group">
    <label for="size_name">Size Name</label>
    <input type="text" class="form-control" id="size_name" aria-describedby="size_name" name="size_name" value="{{$size->size_name}}">
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