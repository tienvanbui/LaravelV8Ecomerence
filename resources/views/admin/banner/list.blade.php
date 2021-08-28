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
                <!-- /.col-lg-12 -->
            </div>
	</div>
	<div class="row">
        <div class="container">
            <h1 class="text-center">BANNERS</h1>
            @if(Session::has('message'))

                <div class="alert alert-success">

                    {{Session::get('message')}}

                </div>

            @endif 
            <table class="table table-hover table-bordered">
                <thead class="table-dark" style="width: 100%">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Thumbnail</th>
                    <th style="width: 8%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php  $id = 0 @endphp
                    @foreach ($banners as $banner)
                    @php $id ++ @endphp
                    <tr>
                    <th scope="row">@php echo $id @endphp</th>
                    <td>{{$banner->title}}</td>
                    <td>{!!$banner->content!!}</td>
                    <td ><img src="{{asset($banner->thumb)}}" style="width: 20rem"></td>
                    <td>
                        <a href="{{route('banner.edit',['banner'=>$banner->id])}}" class="btn btn-success btn-sm text-white" ><i class="fas fa-edit"></i></a>
                        @include('partials.delete',[
                            'route'=>'banner.destroy',
                            'item_name'=>'banner',
                            'item'=>$banner
                        ])
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {{$banners->links()}}
        </div>
	</div>
</div>
@endsection
@include('partials.main')
@include('partials.footer')