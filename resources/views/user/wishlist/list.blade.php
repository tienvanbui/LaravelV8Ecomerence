@section('title')
    Wishlist
@endsection
@include('common.layout.header')
    <!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url({{asset('/images/user/wishlist/wish.png')}});">
		<h2 class="ltext-105 cl0 txt-center mt-5 font-weight-bold">
			Wellcome To Wishlist
		</h2>
	</section>
    <section class="bg0 p-t-104 p-b-116">
		<div class="container">
			<div class="row">
				@foreach ($wishlistProducts as $product)
				<div class="col-sm-12 col-md-4">
					<div class="block2-pic hov-img0">
					<div class="card text-center border-none" style="width: 18rem;">
						<img class="card-img-top" src="{{$product->feature_img}}" alt="{{$product->feature_img_name}}" class="">
						<div class="card-body">
							<h5 class="card-title text-center text-dark font-weight-bold">{{$product->name}}</h5>
							<p class="card-text text-center text-dark font-weight-bold mb-3">{{'$'.number_format($product->Price)}}</p>
							<a href="{{route('shop.show',['product'=>$product->id])}}" class="btn btn-dark text-white mt-2 ">Detail</a>
							<form action="{{route('remove-from-wishlist',['id'=>$product->id])}}" method="POST" class="d-inline-block">
								@method('DELETE')
								@csrf
								<button type="submit" class="btn btn-danger text-white mt-2 ">Remove</button>
							</form>
							
						</div>
					</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</section>		
@include('common.layout.footer')