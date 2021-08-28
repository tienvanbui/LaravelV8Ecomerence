@section('title')
    Create Sliders
@endsection
@include('partials.header')
@include('partials.slidebar')
@section('main-content')
<div class="container">
	<div class="row"> 
        <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Sliders</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <li><a href="{{route('slide.index')}}" class="fw-normal">Sliders List</a></li>
                            </ol>
                            <a href="{{route('slide.create')}}"
                                class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Create Slider</a>
                        </div>
                    </div>
                </div>
        </div> 
	</div>
    <div class="row">
        <div class="container">
            <h1 class="text-center">CREATE SLIDER</h1> 
            <form action="{{route('slide.store')}}" method="post" enctype="multipart/form-data">
                 @csrf
                 <div class="form-group">
                    <label for="name">Title</label>
                    <input type="text" class="form-control" id="name" aria-describedby="name"  name="name">
                </div>
                <div class="form-group">
                    <label for="img_slider">Image</label>
                    <input type="file" class="form-control-file" id="img_slider" aria-describedby="img_slider" name="img_slider">
                </div>
                 <div class="form-group">
                    <label for="des">Description</label>
                    <textarea name="des"cols="30" rows="10" class="form-control" id="ckeditor_slider_create"></textarea>
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