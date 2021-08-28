@section('title')
  Coupons List
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
                <li><a href="{{ route('coupon.index') }}" class="fw-normal">Coupons List</a></li>
              </ol>
              <a href="{{ route('coupon.create') }}"
                class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Create
                Coupon</a>
            </div>
          </div>
        </div>
        <!-- /.col-lg-12 -->
      </div>
    </div>
    <div class="row">
      <div class="container">
        <h1 class="text-center">COUPONS LIST</h1>
        @if (Session::has('message'))

          <div class="alert alert-success">

            {{ Session::get('message') }}

          </div>

        @endif
        <table class="table table-hover table-sm">
          <thead style="background-color: #021919;color:white">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Coupon Code</th>
              <th scope="col">Discount Type</th>
              <th scope="col">Discount Price</th>
              <th scope="col">Number Of Coupons Available</th>
              <th scope="col">Number Of Coupons Used</th>
              <th style="width: 10%">Action</th>
            </tr>
          </thead>
          <tbody>
            @php  $id = 0 @endphp
            @foreach ($coupons as $coupon)
              @php $id ++ @endphp
              <tr>
                <th scope="row">@php echo $id @endphp</th>
                <td>{{ $coupon->coupon_code }}</td>
                <td>
                  @if ($coupon->coupon_codition == 0)
                    discount as a money
                  @else
                    discount as a percentage
                  @endif
                </td>
                <td>
                  @if ($coupon->coupon_codition == 0)
                    {{'$'.$coupon->coupon_price_discount}}
                  @else
                    {{$coupon->coupon_price_discount.'%'}}
                  @endif
                </td>
                <td>{{ $coupon->coupon_use_number }}</td>
                <td>{{ $coupon->coupon_used_count }}</td>
                <td>
                  <a href="{{ route('coupon.edit', ['coupon' => $coupon->id]) }}"
                    class="btn btn-success btn-sm text-white"><i class="fas fa-edit"></i></a>
                  @include('partials.delete',[
                  'route'=>'coupon.destroy',
                  'item_name'=>'coupon',
                  'item'=>$coupon
                  ])
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="d-flex justify-content-center">
        {{ $coupons->links() }}
      </div>
    </div>
  </div>
@endsection
@include('partials.main')
@include('partials.footer')
