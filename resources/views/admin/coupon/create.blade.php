@section('title')
    Create New Coupon 
@endsection
@include('partials.header')
@include('partials.slidebar')
@section('main-content')
<div class="container">
	<div class="row">            
		<div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Coupon</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <li><a href="{{route('coupon.index')}}" class="fw-normal">Coupons List</a></li>
                            </ol>
                            <a href="{{route('coupon.create')}}"
                                class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Create Coupon</a>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
	</div>
	<div class="row">
        <div class="container">
        <h1 class="text-center">CREATE COUPON </h1>
        <form action="{{ route('coupon.store') }}" method="post">
          @csrf
          <div class="form-group">
            <label for="coupon_code">Code:</label>
            <input type="text" class="form-control" id="coupon_code" aria-describedby="coupon_code" placeholder="Enter Coupon Code"
              name="coupon_code" value="{{old('coupon_code')}}">
          </div>
          <div class="form-group">
            <label for="coupon_codition">Discount Type:</label>
            <select name="coupon_codition" id="coupon_codition" class="form-control">
                <option selected >Choose Discount Type</option>
                <option value="0">discount as a money</option>
                <option value="1">discount as a percentage</option>
            </select>
          </div>
           <div class="form-group">
            <label for="coupon_price_discount">Discount Price:</label>
            <input type="number" class="form-control" id="coupon_price_discount" aria-describedby="coupon_price_discount" name="coupon_price_discount" value="{{old('coupon_price_discount')}}">
          </div>
          <div class="form-group">
            <label for="coupon_use_number" class="text-capitalize">number of coupons available:</label>
            <input type="number" class="form-control" id="coupon_use_number" aria-describedby="coupon_use_number" name="coupon_use_number" value="{{old('coupon_use_number')}}">
          </div>
          <div class="form-group">
            <label for="coupon_used_count" class="text-capitalize">number of coupons used:</label>
            <input type="number" class="form-control" id="coupon_used_count" aria-describedby="coupon_used_count" name="coupon_used_count" value="{{old('coupon_used_count')}}">
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
