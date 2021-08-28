@section('title')
  Order
@endsection
@include('partials.header')
@include('partials.slidebar')
@section('main-content')
  <div class="container">
    <div class="row">
      <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Order</h4>
          </div>
          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <div class="d-md-flex">
              <ol class="breadcrumb ms-auto">
                <li><a href="{{ route('ordercheck.index') }}" class="fw-normal">Orders List</a></li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="container">
        <div class="row">
          <div class="col-md-6 mt-5">
            <div class="card">
              <h5 class="card-header bg-dark text-white text-center">User Information</h5>
              <div class="card-body">

                <p class="card-text"><strong>Name</strong>{{ ':' . $order->user->name }}</p>
                <p class="card-text"><strong>Address</strong>{{ ':' . $order->user->adrress }}</p>
                <p class="card-text"><strong>Phone</strong>{{ ':' . $order->user->phoneNumber }}</p>
                <p class="card-text"><strong>Address Shipping</strong>{{ ':' . $order->address_shipping }}</p>
                <p class="card-text"><strong>Phone Shipping</strong>{{ ':' . $order->phoneNumber_shipping }}</p>
                <p class="card-text"><strong>Time Order</strong>{{ ':' . $order->created_at }}</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 mt-5">
            <div class="card">
              <h5 class="card-header bg-dark text-white text-center">Payment Information</h5>
              <div class="card-body">

                <p class="card-text"><strong>Payment Method</strong>{{ ':' . $order->payment->payment_method }}</p>

              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="container">
            <div class="row">
              <div class="col-sm-12 col-md-12 mt-5">
                <table class="table">
                  <thead style="background-color: #021919;color:white">
                    <tr>
                      <th scope="col">Product</th>
                      <th scope="col">Image</th>
                      <th scope="col">Quanlity</th>
                      <th scope="col">Color</th>
                      <th scope="col">Size</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($productsInOrder as $item)
                    <tr>                   
                        <td>{{$item->name}}</td>
                        <td><img src="{{$item->feature_img}}" alt="{{$item->feature_img_name}}" width="100rem" height="100rem"></td>
                        <td>{{$item->pivot->buy_quanlity}}</td>
                        <td>{{ ucwords(App\Models\Order::getColorName($item)->color_name) }}</td>
                         <td>{{ strtoupper(App\Models\Order::getSizeName($item)->size_name) }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endsection
    @include('partials.main')
    @include('partials.footer')
