@section('title')
    Shopping Cart
@endsection
@include('common.layout.header')
	<!-- Shoping Cart -->
	<div class="bg0 p-t-75 p-b-85 mt-5">
		
		<div class="container">
			<div class="row">
			@if(session()->has('notification'))
			<div class="col-lg-10 col-xl-7 ">
			<div class="alert alert-success fade show m-l-25 m-r--38 m-lr-0-xl" role="alert">
				<strong>{{session('notification')}}</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			</div>
			@endif
			</div>
			<div class="row">
			@if(session::has('messageSuccess'))
			<div class="col-lg-10 col-xl-7 ">
			<div class="alert alert-success fade show m-l-25 m-r--38 m-lr-0-xl" role="alert">
				<strong>{{session::pull('messageSuccess')}}</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			</div>
			@endif
			</div>
			@if (!empty($cart->products))
			<div class="row">
				<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
					<div class="m-l-25 m-r--38 m-lr-0-xl">
						<div class="wrap-table-shopping-cart">
							<table class="table-shopping-cart">
								<tr class="table_head">
									<th class="column-1">Product</th>
									<th class="column-2"></th>
									<th class="column-3">Price</th>
									<th class="column-4 pr-5">Quantity</th>
									<th class="column-5">Total</th>
									<th class="column-6 pl-2">Action</th>
								</tr>
								
                                @foreach ($cart->products as $item)
                                <tr class="table_row">
									<td class="column-1">
										<form action="{{route('cart.delete',[
											'id'=>$item->pivot->product_id,
										])}}" method="POST">
										@csrf
										@method('DELETE')
											<button type='submit' class="how-itemcart1">
													<img src="{{asset($item->feature_img)}}" alt="{{$item->feature_img_name}}">
											</button>
										</form>
									</td>
									<td class="column-2">{{$item->name}}</td>
									<td class="column-3">{{$item->Price}}</td>
									<td class="column-4">
							<form action="{{route('cart.update',[
								'id'=>$item->pivot->product_id
							])}}" method="post" >
								@method('PUT')
								@csrf
								<input type="number" name="user_id" class="d-none" value="{{auth()->user()->id}}">
								<input type="number" name="cart_id" class="d-none" value="{{$item->pivot->cart_id}}">
								<input type="number" name="product_id" class="d-none" value="{{$item->pivot->product_id}}">
								<div class="wrap-num-product flex-w m-l-auto m-r-5">
									<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>

											<input class="mtext-104 cl3 txt-center num-product" type="number" name="buy_quanlity" value="{{$item->pivot->buy_quanlity}}">

											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>
									</td>
									<td class="column-5">{{$item->pivot->buy_quanlity * $item->Price}}</td>
								<td  class="column-6">
							
								<button type="submit" class="flex-c-m stext-110 cl2 size-122  bor13 hov-btn3  trans-04 pointer m-tb-10 mr-5">
									Update
								</button>	
							</form>
									</td>
									</tr>
								
                                @endforeach
							</table>
						</div>

					</div>
				</div>
				
					<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
					<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
						<h4 class="mtext-109 cl2 p-b-30">
							Cart Totals
						</h4>

						<div class="flex-w flex-t bor12 p-b-13">
							<div class="size-208">
								<span class="stext-110 cl2">
									Subtotal:
								</span>
							</div>
							
							<div class="size-209">
								<span class="mtext-110 cl2">
									@php
										$total = 0;
										foreach($cart->products as $itemcheck){
											$total += $itemcheck->pivot->buy_quanlity * $itemcheck->Price;
										}
										echo '$'.number_format($total);
									@endphp
								</span>
							</div>
						</div>
						<div class="flex-w flex-t p-t-27 p-b-33">
							<div class="size-208">
								<span class="mtext-101 cl2">
									Total:
								</span>
							</div>

							<div class="size-209 p-t-1">
								<span class="mtext-110 cl2">
									@php
										$total = 0;
										foreach($cart->products as $itemcheck){
											$total += $itemcheck->pivot->buy_quanlity * $itemcheck->Price;
										}
										echo '$'.number_format($total);
									@endphp
								</span>
							</div>
						</div>

						<a href="{{route('payment.confirm')}}" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer text-white">
							Proceed to Checkout
						</a>
					</div>
				</div>
				
				
			</div>
			@endif
		</div>
	</div>
@include('common.layout.footer')