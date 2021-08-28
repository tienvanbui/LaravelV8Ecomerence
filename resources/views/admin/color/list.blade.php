@section('title')
     Color List
@endsection
@include('partials.header')
@include('partials.slidebar')
@section('main-content')
<div class="container">
	<div class="row">            
		<div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Color</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <li><a href="{{route('color.index')}}" class="fw-normal">Colors List</a></li>
                            </ol>
                            <a href="{{route('color.create')}}"
                                class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Create Color</a>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
	</div>
	<div class="row">
	<div class="col-12">
		<h1 class="text-center my-4">COLORS LIST</h1>
		 @if(Session::has('message'))

                <div class="alert alert-success">

                    {{Session::get('message')}}

                </div>

            @endif 
		<table class="table table-hover table-bordered">
		<thead class="table-dark">
			<tr>
			<th scope="col">#</th>
			<th scope="col">Color Name</th>
			<th scope="col">Action</th>
			</tr>
		</thead>
		<tbody>
			@php  $id = 0 @endphp
			@foreach ($color as $item)
			@php $id ++ @endphp
			<tr>
			<th scope="row">@php echo $id @endphp</th>
			<td>{{$item->color_name}}</td>
			<td>
				<a href="{{route('color.edit',['color'=>$item->id])}}" class="btn btn-success text-white btn-sm"><i class="fas fa-edit"></i></a>
				@include('partials.delete',[
					'route'=>'color.destroy',
					'item_name'=>'color',
					'item'=>$item->id,
				])
			</td>
			</tr>

			@endforeach

		</tbody>
	</table>
	</div>
	</div>
</div>
@endsection
@include('partials.main')
@include('partials.footer')