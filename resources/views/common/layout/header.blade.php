<!DOCTYPE html>
<html lang="en">

<head>
  <title>@yield('title')</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{ asset('/fonts/linearicons-v1.0.0/icon-font.min.css') }}">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{ asset('/fonts/iconic/css/material-design-iconic-font.min.css') }}">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{ asset('/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
  <!--===============================================================================================-->
  <link rel="icon" type="image/png" href="{{ asset('/images/user/icons/favicon.png') }}" />
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{ asset('css/user/vendor/bootstrap/css/bootstrap.min.css') }}">



  {{-- <!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('/css/user/vendor/animate/animate.css')}}"> --}}
  <!--===============================================================================================-->
  {{-- <link rel="stylesheet" type="text/css" href="{{asset('/css/user/vendor/css-hamburgers/hamburgers.min.css')}}"> --}}
  <!--===============================================================================================-->
  {{-- <link rel="stylesheet" type="text/css" href="{{asset('/css/uservendor/animsition/css/animsition.min.css')}}"> --}}
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/user/vendor/select2/select2.min.css') }}">
  <!--===============================================================================================-->
  {{-- <link rel="stylesheet" type="text/css" href="{{asset('/css/user/vendor/daterangepicker/daterangepicker.css')}}"> --}}
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/user/vendor/slick/slick.css') }}">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/user/vendor/MagnificPopup/magnific-popup.css') }}">
  <!--===============================================================================================-->
  {{-- <link rel="stylesheet" type="text/css" href="{{asset('/css/user/vendor/perfect-scrollbar/perfect-scrollbar.css')}}"> --}}
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/user/util.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/user/main.css') }}">
  <!--===============================================================================================-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:ital,wght@0,400;1,300&display=swap"
    rel="stylesheet">
</head>

<body>

  <!-- Header -->
  <header>
    <!-- Header desktop -->
    <div class="container-menu-desktop ">
      <!-- Topbar -->
      <div class="top-bar">
        <div class="content-topbar flex-sb-m h-full container">
          <div class="left-top-bar">
            Free shipping for standard order over $100
          </div>

          <div class="right-top-bar flex-w h-full">
            <a href="{{ route('login') }}" class="flex-c-m trans-04 p-lr-25">
              @if (auth()->check())
                <img src="{{ asset(auth()->user()->avatar) }}" alt="user-img" width="30" class="img-circle"><span
                  class="text-white font-medium">{{ auth()->user()->username }}</span>

              @endif
            </a>
            @if (auth()->check())
              <form action="{{ route('logout') }} " method="post" class="flex-c-m trans-04 p-lr-25">
                @csrf
                <button type='submit' class="btn btn-danger btn-sm">
                  Logout
                </button>
              </form>
            @else
              <a href="{{ route('login') }}" class="btn btn-primary btn-lg text-white ml-3" role="button"
                aria-pressed="true" style="border-radius:180px">SignIn</a>
            @endif
          </div>
        </div>
      </div>

      <div class="wrap-menu-desktop bg-white">
        <nav class="limiter-menu-desktop container">

          <!-- Logo desktop -->
          <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('images/user/icons/logo-01.png') }}" alt="IMG-LOGO">
          </a>

          <!-- Menu desktop -->
          <div class="menu-desktop">
            <ul class="main-menu">
              <li>
                <a href="{{ route('home') }}">Home</a>

              </li>
              @php
                $menu = session('menuParents');
              @endphp
              @foreach ($menu as $item)
                <li>
                  <a href=" @if (!auth()->check())
                    {{ route("$item->slug.index") }}
                  @else
                    {{ route("user.$item->slug.index") }}
                    @endif">{{ $item->menu_name }}</a>
                  @if ($item->menus()->count())
                    <ul class="sub-menu">
                      @foreach ($item->menus as $itemChild)
                        <li><a
                            href="{{route('user.shop.showByCategory',['slug'=>$itemChild->slug])}}">{{ $itemChild->menu_name }}</a>
                        </li>
                      @endforeach
                    </ul>
                  @endif
                  <span class="arrow-main-menu">
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                  </span>
                </li>
              @endforeach

              <li>
                <a href="{{ route('view-cart') }}">Shopping Cart</a>
              </li>
              <li class="label1" data-label1="hot">
                <a href=" @if (auth()->check())
                  {{ route('list-blog') }}
                @else
                  {{ route('userBlog.index') }}
                  @endif">Blog</a>
              </li>

              <li>
                <a href="  @if (auth()->check())
                  {{ route('user-view-about-infor') }}
                @else
                  {{ route('client-view-about-infor') }}
                  @endif">About</a>
              </li>

              <li>
                <a href="  @if (auth()->check())
                  {{ route('contact-view') }}
                @else
                  {{ route('client-contact-view') }}
                  @endif">Contact</a>
              </li>
            </ul>
          </div>

          <!-- Icon header -->
          <div class="wrap-icon-header flex-w flex-r-m">
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
              <i class="zmdi zmdi-search"></i>
            </div>

            <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
              data-notify="{{ session('cartCount') }}">
              <i class="zmdi zmdi-shopping-cart"></i>
            </div>

            <a href="{{ route('view-wishlist') }}"
              class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-wishlist"
              data-notify="0">
              <i class="zmdi zmdi-favorite-outline"></i>
            </a>
          </div>
        </nav>
      </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
      <!-- Logo moblie -->
      <div class="logo-mobile">
        <a href="index.html"><img src="images/icons/logo-01.png" alt="IMG-LOGO"></a>
      </div>

      <!-- Icon header -->
      <div class="wrap-icon-header flex-w flex-r-m m-r-15">
        <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
          <i class="zmdi zmdi-search"></i>
        </div>

        <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="2">
          <i class="zmdi zmdi-shopping-cart"></i>
        </div>

        <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti"
          data-notify="0">
          <i class="zmdi zmdi-favorite-outline"></i>
        </a>
      </div>

      <!-- Button show menu -->
      <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
        <span class="hamburger-box">
          <span class="hamburger-inner"></span>
        </span>
      </div>
    </div>


    <!-- Menu Mobile -->
    <div class="menu-mobile">
      <ul class="topbar-mobile">
        <li>
          <div class="left-top-bar">
            Free shipping for standard order over $100
          </div>
        </li>

        <li>
          <div class="right-top-bar flex-w h-full">
            <a href="#" class="flex-c-m p-lr-10 trans-04">
              Help & FAQs
            </a>

            <a href="#" class="flex-c-m p-lr-10 trans-04">
              My Account
            </a>

            <a href="#" class="flex-c-m p-lr-10 trans-04">
              EN
            </a>

            <a href="#" class="flex-c-m p-lr-10 trans-04">
              USD
            </a>
          </div>
        </li>
      </ul>

      <ul class="main-menu-m">
        <li>
          <a href="index.html">Home</a>
          <ul class="sub-menu-m">
            <li><a href="index.html">Homepage 1</a></li>
            <li><a href="home-02.html">Homepage 2</a></li>
            <li><a href="home-03.html">Homepage 3</a></li>
          </ul>
          <span class="arrow-main-menu-m">
            <i class="fa fa-angle-right" aria-hidden="true"></i>
          </span>
        </li>

        <li>
          <a href="product.html">Shop</a>
        </li>

        <li>
          <a href="shoping-cart.html" class="label1 rs1" data-label1="hot">Features</a>
        </li>

        <li>
          <a href="blog.html">Blog</a>
        </li>

        <li>
          <a href="about.html">About</a>
        </li>

        <li>
          <a href="contact.html">Contact</a>
        </li>
      </ul>
    </div>

    <!-- Modal Search -->
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
      <div class="container-search-header">
        <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
          <img src="{{ asset('/images/user/icons/icon-close2.png') }}" alt="CLOSE">
        </button>

        <form class="wrap-search-header flex-w p-l-15">
          <button class="flex-c-m trans-04">
            <i class="zmdi zmdi-search"></i>
          </button>
          <input class="plh3" type="text" name="search" placeholder="Search...">
        </form>
      </div>
    </div>
  </header>

  <!-- Cart -->
  <div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
      <div class="header-cart-title flex-w flex-sb-m p-b-8">
        <span class="mtext-103 cl2">
          Your Cart
        </span>

        <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
          <i class="zmdi zmdi-close"></i>
        </div>
      </div>

      <div class="header-cart-content flex-w js-pscroll">
        @php
          $cart = Session::get('cart');
        @endphp

        <ul class="header-cart-wrapitem w-full">
          @if (session()->has('cart'))
            @foreach ($cart->products as $item)
              <li class="header-cart-item flex-w flex-t m-b-12">
                <div class="header-cart-item-img">
                  <img src="{{ asset($item->feature_img) }}" alt="{{ $item->feature_img_name }}">
                </div>

                <div class="header-cart-item-txt p-t-8">
                  <a href="{{ route('shop.show', [
    'product' => $item->pivot->product_id,
]) }}"
                    class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                    {{ $item->name }}
                  </a>

                  <span class="header-cart-item-info">
                    {{ $item->pivot->buy_quanlity . 'x' . $item->Price }}
                  </span>
                </div>
              </li>
            @endforeach
        </ul>

        <div class="w-full">
          <div class="header-cart-total w-full p-tb-40">
            Total:
            @php
              $total = 0;
              foreach ($cart->products as $itemcheck) {
                  $total += $itemcheck->pivot->buy_quanlity * $itemcheck->Price;
              }
              echo '$' . number_format($total);
            @endphp
          </div>

          <div class="header-cart-buttons flex-w w-full">
            <a href="{{ route('view-cart') }}"
              class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
              View Cart
            </a>

            <a href="{{ route('payment.confirm') }}"
              class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
              Check Out
            </a>
          </div>
        </div>
      @else
        <ul class="header-cart-wrapitem w-full">
          <li class="header-cart-item flex-w flex-t m-b-12">
            <div class="header-cart-item-img">
            </div>
          </li>
        </ul>
        @endif

      </div>
    </div>
  </div>
