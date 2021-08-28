@section('title')
  Confirm Payment Method And Payment
@endsection
@include('common.layout.header')
<div class="bg0 p-t-75 p-b-85 mt-5">
  <div class="container">
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
              </tr>
              @foreach ($cart->products as $item)
                <tr class="table_row">
                  <td class="column-1">

                    <div class="how-itemcart1">
                      <img src="{{ asset($item->feature_img) }}" alt="{{ $item->feature_img_name }}">
                    </div>
                  </td>
                  <td class="column-2">{{ $item->name }}</td>
                  <td class="column-3">{{ $item->Price }}</td>
                  <td class="column-4">
                    <div class="wrap-num-product flex-w m-l-auto ">
                      <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                        <i class="fs-16 zmdi zmdi-minus"></i>
                      </div>

                      <input class="mtext-104 cl3 txt-center num-product" type="number" name="buy_quanlity"
                        value="{{ $item->pivot->buy_quanlity }}">

                      <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                        <i class="fs-16 zmdi zmdi-plus"></i>
                      </div>
                    </div>
                  </td>
                  <td class="column-5">{{ $item->pivot->buy_quanlity * $item->Price }}</td>
                </tr>
              @endforeach
            </table>
          </div>
          <form action="{{ route('checkCoupon') }}" method="POST">
            @csrf
            @if ($message = session::pull('coupon_message_success'))
              <div class="alert alert-success alert-block">
                  <button type="button" class="close" data-dismiss="alert">×</button>    
                  <strong>{{ $message }}</strong>
              </div>
            @endif
            @if ($message = session::pull('coupon_message_fail'))
              <div class="alert alert-danger alert-block">
                  <button type="button" class="close" data-dismiss="alert">×</button>    
                  <strong>{{ $message }}</strong>
              </div>
            @endif
           <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-l-40 p-lr-15-sm">
              <div class="flex-w flex-m m-r-20 m-tb-5">
                <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-60 ml-4 mr-5 m-tb-5" type="text" name="coupon_code"
                  placeholder="Coupon Code" style="width:390px" value="{{session::pull('coupon_code')}}">
                <button class="flex-c-m stext-101 cl2 size-119 bg-dark bor13 hov-btn3 p-r-15 trans-04 pointer m-tb-10  text-white" type="submit">
                  Apply coupon
                </button>
              </div>
            </div>
          </form>
          <form action="{{ route('order.store') }}" method="POST">
            @csrf
            
            <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-l-40 p-lr-15-sm">
              <span class="text-dark font-weight-bold ml-4">If use payment by card.You will be discount 2%</span>  
              <div class="flex-w flex-m m-r-20 m-tb-5">

                @foreach ($payments as $paymentMethod)
                  <div class="form-check ml-5">
                    <input class="form-check-input" type="checkbox" value="{{ $paymentMethod->id }}"
                      id="defaultCheck1" name="payment_id">
                    <label class="form-check-label" for="defaultCheck1">
                      {{ $paymentMethod->payment_method }}
                    </label>
                  </div>
                @endforeach
                <div class="form-group">
                  <input type="number" class="d-none" name="total" value="<?php
                    $total = 0;
                    foreach ($cart->products as $itemcheck) {
                        $total += $itemcheck->pivot->buy_quanlity * $itemcheck->Price;
                    }
                    if(session::get('discount_type') == 1) echo $total - ($total * (session::get('price_discount')/100));
                    else if(session::get('discount_type') == 0) echo $total - session::get('price_discount');
                    else echo $total
                    ?>">
                </div>
                <div class="form-goup">
                  <input type="number" class="d-none" value="{{ $cart->id }}" name="cart_id">
                </div>
                 <div class="form-goup">
                  <input type="string" class="d-none" value="{{$coupon_code}}" name="coupons_code">
                </div>
              </div>
              <button type="submit"
                class="flex-c-m stext-101 cl2 size-119 bg-dark bor13 hov-btn3 p-r-15 trans-04 pointer m-tb-10 mr-4 text-white">
                Payment
              </button>

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
                  foreach ($cart->products as $itemcheck) {
                      $total += $itemcheck->pivot->buy_quanlity * $itemcheck->Price;
                  }
                  echo '$' . number_format($total);
                @endphp
              </span>
            </div>
          </div>
           <div class="flex-w flex-t bor12 p-t-15 p-b-30">
            <div class="size-208 w-full-ssm">
              <span class="stext-110 cl2">
                Discount:
              </span>
            </div>

            <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
              <p>
                @if(session::get('discount_type') === 0)
                      {{'-$'.session::get('price_discount')}}
                @elseif (session::get('discount_type') === 1)
                    {{'-'.session::get('price_discount').'%'}}
                @else
                    You cann't get a discount 
                @endif
              </p>
            </div>
          </div>
          <div class="flex-w flex-t bor12 p-t-15 p-b-30">
            <div class="size-208 w-full-ssm">
              <span class="stext-110 cl2">
                Shipping:
              </span>
            </div>

            <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
              <p class="stext-111 cl6 p-t-2">
                We will ship products to address you write below.Please check your address to receive your
                products.Thanks!
              </p>

              <div class="p-t-15">
                <span class="stext-112 cl8">
                  Calculate Shipping
                </span>
                <div class="bor8 bg0 m-b-12">
                  <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="address" placeholder="Address"
                    value="{{ auth()->user()->adrress }}">
                </div>
                <div class="bor8 bg0 m-b-12">
                  <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="phoneNumber"
                    placeholder="phone number" value="{{ auth()->user()->phoneNumber }}">
                </div>
              </div>
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
                  foreach ($cart->products as $itemcheck) {
                      $total += $itemcheck->pivot->buy_quanlity * $itemcheck->Price;
                  }
                  if(session::pull('discount_type')== 1)
                    echo '$'.number_format($total - ($total * ((session::pull('price_discount')/100))));
                  else if (session::pull('discount_type') == 0) echo '$'.number_format($total - session::pull('price_discount'));
                  else 
                  echo '$'.number_format($total)
                @endphp
              </span>
            </div>
          </div>

        </div>
      </div>

      </form>
    </div>
  </div>
</div>
@include('common.layout.footer')
