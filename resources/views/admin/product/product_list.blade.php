@section('title')
    Products List
@endsection
@include('partials.header')
@include('partials.slidebar')
@section('main-content')
<div class="container">
	<div class="row">            
		<div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Product</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <li><a href="{{route('product.index')}}" class="fw-normal">Products List</a></li>
                            </ol>
                            <a href="{{route('product.create')}}"
                                class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Add Product</a>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
	</div>
	<div class="row">
        <div class="container">
            <h1 class="text-center">PRODUCTS LIST</h1>
            @if(Session::has('message'))

                <div class="alert alert-success">

                    {{Session::get('message')}}

                </div>

            @endif 
            <table class="table table-hover table-bordered">
                <thead class="table-dark" style="width: 100%">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Product Seo</th>
                    <th scope="col">Product Image</th>
                    <th scope="col">Product Image Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Category ID</th>
                    <th style="width: 11%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php  $id = 0 @endphp
                    @foreach ($products as $product)
                    @php $id ++ @endphp
                    <tr>
                    <th scope="row">@php echo $id @endphp</th>
                    <td>{{$product->name}}</td>
                    <td>{{$product->seo_product}}</td>
                    <td ><img src="{{asset($product->feature_img)}}" alt="{{$product->feature_img_name}}" width="220px" height="200px"></td>
                    <td>{{$product->feature_img_name}}</td>
                    <td>{{number_format($product->Price)}}</td>
                    <td>{{$product->category_id}}</td>
                    <td>
                        <a href="{{route('product.show',['product'=>$product->id])}}" class="btn btn-info btn-sm text-white" ><i class="fas fa-eye"></i></a>
                        <a href="{{route('product.edit',['product'=>$product->id])}}" class="btn btn-success btn-sm text-white" ><i class="fas fa-edit"></i></a>
                        @include('partials.delete',[
                            'route'=>'product.destroy',
                            'item_name'=>'product',
                            'item'=>$product
                        ])
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {{$products->links()}}
        </div>
	</div>
</div>
@endsection
@include('partials.main')
@include('partials.footer')