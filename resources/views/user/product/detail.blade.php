@section('title')
  Product Detail
@endsection
@include('common.layout.header')
<!-- Product Detail -->
<section class="sec-product-detail bg0 p-t-65 p-b-60 mt-5">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-lg-7 p-b-30 overflow-hidden">
        <div class="p-l-25 p-r-30 p-lr-0-lg overflow-hidden">
          <div class="wrap-slick3 flex-sb flex-w overflow-hidden">
            <div class="wrap-slick3-dots"></div>
            <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>
            <div class="slick3 gallery-lb">
              @foreach ($productImgs as $item)
                <div class="item-slick3" data-thumb="{{ asset($item->img_path) }}">
                  <div class="wrap-pic-w pos-relative">
                    <img src="{{ asset($item->img_path) }}" alt="{{ $item->img_path_name }}">

                    <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                      href="{{ asset($item->img_path) }}">
                      <i class="fa fa-expand"></i>
                    </a>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-5 p-b-30">
        <div class="p-r-50 p-t-5 p-lr-0-lg">
          <h4 class="mtext-105 cl2 js-name-detail p-b-14">
            {{ $product->name }}
          </h4>

          <span class="mtext-106 cl2">
            ${{ $product->Price }}
          </span>

          <p class="stext-102 cl3 p-t-23">
            {{ $product->seo_product }}
          </p>
          <!--  -->
          <div class="p-t-33">
            <div class="flex-w flex-r-m p-b-10">
              <div class="size-203 flex-c-m respon6">
                Color
              </div>
              <div class="size-204 respon6-next">
                <div class="rs1-select2 bor8 bg0">
                  <form method="Post" action="{{route('save-cart')}}">
                    @csrf
                    <select class="js-select2" name="color_id">
                      <option>Choose an option</option>
                      @foreach ($product->colors as $color)
                        <option value="{{ $color->id }}">{{ ucwords($color->color_name) }}</option>
                      @endforeach
                    </select>
                    <div class="dropDownSelect2"></div>
                </div>
              </div>
            </div>

            <div class="flex-w flex-r-m p-b-10">
              <div class="size-203 flex-c-m respon6">
                Size
              </div>
              <div class="size-204 respon6-next">
                <div class="rs1-select2 bor8 bg0">
                  <select class="js-select2" name="size_id">
                    <option>Choose an option</option>
                    @foreach ($product->sizes as $size)
                      <option value="{{ $size->id }}">Size {{ strtoupper($size->size_name) }}</option>
                    @endforeach
                  </select>
                  <div class="dropDownSelect2"></div>
                </div>
              </div>
            </div>

            <div class="flex-w flex-r-m p-b-10">


              <div class="size-204 flex-w flex-m respon6-next">

                <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                  <input name="product_id" type="number" class="d-none" value="{{ $product->id }}">
                  <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                    <i class="fs-16 zmdi zmdi-minus"></i>
                  </div>

                  <input class="mtext-104 cl3 txt-center num-product" type="number" name="buy_quanlity" value="1">


                  <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                    <i class="fs-16 zmdi zmdi-plus"></i>
                  </div>
                </div>

                <button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail"
                  type="submit">
                  Add to cart
                </button>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="bor10 m-t-50 p-t-43 p-b-40">
      <!-- Tab01 -->
      <div class="tab01">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item p-b-10">
            <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a>
          </li>

          <li class="nav-item p-b-10">
            <a class="nav-link" data-toggle="tab" href="#information" role="tab">Additional information</a>
          </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content p-t-43">
          <!-- - -->
          <div class="tab-pane fade show active" id="description" role="tabpanel">
            <div class="how-pos2 p-lr-15-md">
              <p class="stext-102 cl6">
                {!! $product->productdetail->des !!}}
              </p>
            </div>
          </div>

          <!-- - -->
          <div class="tab-pane fade" id="information" role="tabpanel">
            <div class="row">
              <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                <ul class="p-lr-28 p-lr-15-sm">
                  <li class="flex-w flex-t p-b-7">
                    <span class="stext-102 cl3 size-205">
                      Weight
                    </span>

                    <span class="stext-102 cl6 size-206">
                      {{ $product->productdetail->weight . 'g' }}
                    </span>
                  </li>

                  <li class="flex-w flex-t p-b-7">
                    <span class="stext-102 cl3 size-205">
                      Dimensions
                    </span>

                    <span class="stext-102 cl6 size-206">
                      {{ $product->productdetail->dimension . 'cm' }}
                    </span>
                  </li>
                  <li class="flex-w flex-t p-b-7">
                    <span class="stext-102 cl3 size-205">
                      Color
                    </span>
                    @php
                      
                    @endphp
                    <span class="stext-102 cl6 size-206">
                      @foreach ($product->colors as $color)
                        {{ ucwords($color->color_name) . ',' }}
                      @endforeach
                    </span>
                  </li>

                  <li class="flex-w flex-t p-b-7">
                    <span class="stext-102 cl3 size-205">
                      Size
                    </span>
                    <span class="stext-102 cl6 size-206">
                      <span class="stext-102 cl6 size-206">
                        @foreach ($product->sizes as $size)
                          {{ strtoupper($size->size_name) . ',' }}
                        @endforeach
                      </span>
                    </span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- Related Products -->
<section class="sec-relate-product bg0 p-t-45 p-b-105">
  <div class="container">
    <div class="p-b-45">
      <h3 class="ltext-106 cl5 txt-center">
        Related Products
      </h3>
    </div>

    <!-- Slide2 -->
    <div class="wrap-slick2">
      <div class="slick2">
        @foreach ($relatedToProducts as $relateItem)
          <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
            <!-- Block2 -->
            <div class="block2">
              <div class="block2-pic hov-img0">
                <img src="{{ asset($relateItem->feature_img) }}" alt="{{ $relateItem->feature_img_name }}"
                  style="width:300px;height:289px">

                <a href="{{ route('shop.show', [
    'product' => $relateItem->id,
]) }}"
                  class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                  Detail Product
                </a>
              </div>

              <div class="block2-txt flex-w flex-t p-t-14">
                <div class="block2-txt-child1 flex-col-l ">
                  <a href="{{ route('shop.show', [
    'product' => $relateItem->id,
]) }}"
                    class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                    {{ ucwords($relateItem->name) }}
                  </a>

                  <span class="stext-105 cl3">
                    {{ '$' . number_format($relateItem->Price) }}
                  </span>
                </div>

                <div class="block2-txt-child2 flex-r p-t-3">
                  <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                    <img class="icon-heart1 dis-block trans-04"
                      src="{{ asset('/images/user/icons/icon-heart-01.png') }}">
                    <img class="icon-heart2 dis-block trans-04 ab-t-l"
                      src="{{ asset('/images/user/icons/icon-heart-02.png') }}">
                  </a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>

  </div>
</section>
@include('common.layout.footer')
