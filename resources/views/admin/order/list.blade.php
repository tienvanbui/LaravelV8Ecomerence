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
        <h1 class="text-center">ORDERS</h1>
        @if (Session::has('message'))

          <div class="alert alert-success">

            {{ Session::get('message') }}

          </div>

        @endif
        <table class="table table-sm">
          <thead style="background-color: #021919;color:white">
            <tr>
              <th scope="col">User</th>
              <th scope="col">Purchased</th>
              <th scope="col">Date</th>
              <th scope="col">Payment Method</th>
              <th scope="col">Total</th>
              <th scope="col">Coupon Code</th>
              <th scope="col">Status</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($orders as $order)
              <tr class="mt-1">
                <td>{{ $order->user->username }}</td>
                <td>{{ $order->itemPurchased($order->user_id) .' '.'item'}}</td>
                <td>{{ $order->created_at }}</td>
                <td>{{ $order->payment->payment_method }}</td>
                <td>{{ '$'.$order->total }}</td>
                 <td>
                   @if (isset($order->coupon_code))
                       {{ $order->coupon_code }}
                  @else
                      <?php $noti = "none"; ?>
                     {{$noti}}
                   @endif
                 </td>
                <td>
                  @if($order->status == 1)
                      <form action="{{route('order.confirm-order',['order'=>$order->id])}}" method="POST">
                        @csrf
                        <input type="number" class="d-none" value="0" name="status">
                        <button  class="text-white btn btn-danger btn-sm mt-1">Queue</button>
                      </form>
                  @else
                      <form action="{{route('order.confirm-order',['order'=>$order->id])}}" method="POST">
                        @csrf
                        <input type="number" class="d-none" value="1" name="status">
                        <button  class="text-white btn btn-primary btn-sm mt-1">Confirmed</button>
                      </form>
                  @endif
                </td>
                <td>
                  <a href="{{ route('ordercheck.show', ['order' => $order->id]) }}"
                  class="btn btn-info btn-inline text-white btn-sm"><i class="fas fa-eye"></i>
                  </a>
                  @include('partials.delete',[
                  'route'=>'ordercheck.destroy',
                  'item_name'=>'order',
                  'item'=>$order
                  ])
                </td>
              </tr>
            @endforeach

          </tbody>
        </table>

      </div>
    @endsection
    @include('partials.main')
    @include('partials.footer')
