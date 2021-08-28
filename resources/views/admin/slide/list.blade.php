@section('title')
    Sliders List
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
            <h1 class="text-center">SLIDERS</h1> 
	<table class="table table-hover table-bordered">
        <thead class="table-dark" style="width: 100%">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th style="width: 30%">Image</th>
            <th scope="col">Description</th>
            <th style="width: 8%">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sliders as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td><img src="{{asset($item->img_slider)}}" width="100%"></td>
                <td>{!!$item->des!!}</td>
                <td>
                    <a href="{{route('slide.edit',['slide'=>$item->id])}}" class="btn btn-success btn-sm text-white" ><i class="fas fa-edit"></i></a>
                    @include('partials.delete',[
                        'route'=>'slide.destroy',
                        'item_name'=>'slide',
                        'item'=>$item
                    ])
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
        </div>
        <div class="d-flex justify-content-center">
            {{$sliders->links()}}
        </div>
	</div>
</div>
@endsection
@include('partials.main')
@include('partials.footer')