@section('title')
  Product
@endsection
@include('common.layout.header')

<!-- Product -->
<section class="bg0 p-t-23 p-b-140">
  <div class="container">
    <div class="p-b-10">
      <h3 class="ltext-103 cl5">
        Product Overview
      </h3>
    </div>

    <div class="flex-w flex-sb-m p-b-52">
      <div class="flex-w flex-l-m filter-tope-group m-tb-10">
        <h2 class="text-center text-dark">
          @if (isset($_GET['banner_name']))
            {{strtoupper($_GET['banner_name'])}}
          @elseif(isset($title))
            {{strtoupper($title)}}
          @else
            PRODUCT
          @endif
        </h2>
      </div>

      <div class="flex-w flex-c-m m-tb-10">
        <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
          <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
          <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
          Filter
        </div>

        <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
          <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
          <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
          Search
        </div>
      </div>

      <!-- Search product -->
      <div class="dis-none panel-search w-full p-t-10 p-b-15">
        <div class="bor8 dis-flex p-l-15">
          <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
            <i class="zmdi zmdi-search"></i>
          </button>

          <input class="mtext-107 cl2 size-114 plh2 p-r-15 search-product" type="text" name="search-product"
            placeholder="Search">
        </div>
      </div>
      <!-- Filter -->
      <div class="dis-none panel-filter w-full p-t-10">
        <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
          <div class="filter-col1 p-r-15 p-b-27">
            <div class="mtext-102 cl2 p-b-15">
              Sort By
            </div>

            <ul>
              <li class="p-b-6 ">
                <a href="{{ Request::url() }}?sort-by=default" class="filter-link stext-106 trans-04">
                  Default
                </a>
              </li>

              <li class="p-b-6">
                <a href="{{ Request::url() }}?sort-by=popularity" class="filter-link stext-106 trans-04 ">
                  Popularity
                </a>
              </li>

              <li class="p-b-6">
                <a href="{{ Request::url() }}?sort-by=price-from-low-to-high" class="filter-link stext-106 trans-04">
                  Price: Low to High
                </a>
              </li>

              <li class="p-b-6">
                <a href="{{ Request::url() }}?sort-by=price-from-high-to-low" class="filter-link stext-106 trans-04">
                  Price: High to Low
                </a>
              </li>
            </ul>
          </div>

          <div class="filter-col2 p-r-15 p-b-27">
            <div class="mtext-102 cl2 p-b-15">
              Price
            </div>

            <ul>
              <li class="p-b-6">
                <a href="{{ Request::url() }}?price=all" class="filter-link stext-106 trans-04">
                  All
                </a>
              </li>

              <li class="p-b-6">
                <a href="{{ Request::url() }}?price=from-0-to-50" class="filter-link stext-106 trans-04">
                  $0 - $50
                </a>
              </li>

              <li class="p-b-6">
                <a href="{{ Request::url() }}?price=from-50-to-100" class="filter-link stext-106 trans-04">
                  $50 - $100
                </a>
              </li>

              <li class="p-b-6">
                <a href="{{ Request::url() }}?price=from-100-to-150" class="filter-link stext-106 trans-04">
                  $100 - $150
                </a>
              </li>

              <li class="p-b-6">
                <a href="{{ Request::url() }}?price=from-150-to-200" class="filter-link stext-106 trans-04">
                  $150- $200
                </a>
              </li>

              <li class="p-b-6">
                <a href="{{ Request::url() }}?price=200plus" class="filter-link stext-106 trans-04">
                  $200+
                </a>
              </li>
            </ul>
          </div>

          <div class="filter-col3 p-r-15 p-b-27">
            <div class="mtext-102 cl2 p-b-15">
              Color
            </div>

            <ul>
              @foreach ($colors as $color)
                <li class="p-b-6">
                  <span class="fs-15 lh-12 m-r-6" style="color: {{ $color->color_name }};">
                    <i class="zmdi zmdi-circle"></i>
                  </span>

                  <a href="{{ Request::url() }}?color={{ $color->color_name }}"
                    class="filter-link stext-106 trans-04">
                    {{ ucwords($color->color_name) }}
                  </a>
                </li>
              @endforeach

            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="row isotope-grid">
      @foreach ($products as $item)
        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
          <!-- Block2 -->
          <div class="block2">
            <div class="block2-pic hov-img0">
              <img src="{{ asset($item->feature_img) }}" alt="{{ $item->feature_img_name }}">

              <a href="#"
                class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                Qick View
              </a>
            </div>
            <div class="block2-txt flex-w flex-t p-t-14">
              <div class="block2-txt-child1 flex-col-l ">
                <a href="{{ route('shop.show', ['product' => $item]) }}"
                  class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                  {{ ucwords($item->name) }}
                </a>

                <span class="stext-105 cl3">
                  {{ '$' . number_format($item->Price) }}
                </span>
              </div>
              <form action="{{ route('loveduser') }}" method="POST">
                @csrf
                <input type="text" class="d-none" value="{{ $item->id }}" name="product_id">
                <input type="number" class="d-none" value="1" name="isLove">
                <div class="block2-txt-child2 flex-r p-t-3">
                  <button type="submit" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">             
                      <img class="icon-heart1 dis-block trans-04"
                      src="{{ asset('/images/user/icons/icon-heart-01.png') }}" alt="ICON">
                      <img class="icon-heart2 dis-block trans-04 ab-t-l"
                      src="{{ asset('/images/user/icons/icon-heart-02.png') }}" alt="ICON">
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      @endforeach
      {{-- @include('user.product.view') --}}
    </div>

    <!-- Load more -->
    <div class="flex-c-m flex-w w-full p-t-45">
      <a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
        Load More
      </a>
    </div>
  </div>
</section>
@include('common.layout.footer')
