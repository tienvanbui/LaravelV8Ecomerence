@extends('layouts.app');
@section('title')
  Register
@endsection
@section('content')
  <div class="row justify-content-center">
    <div class="col-md-6 text-center mb-5">
      <h2 class="heading-section">{{ __('Register New Account') }}</h2>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-4">
      <div class="login-wrap p-0">
        <form method="POST" action="{{ route('register') }}">
          @csrf
          <div class="form-group ">
              <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Your Name"
                value="{{ old('name') }}" required autocomplete="name" autofocus>

              @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
          </div>
          <div class="form-group">
              <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Username"
                name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

              @error('username')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
          </div>
          <div class="form-group ">
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Your Email"
                value="{{ old('email') }}" required autocomplete="email">

              @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
          </div>
          <div class="form-group ">
              <input id="phoneNumber" type="text" class="form-control @error('phoneNumber') is-invalid @enderror" name="phoneNumber" placeholder="Your Phone Number"
                value="{{ old('phoneNumber') }}" required autocomplete="phoneNumber">

              @error('phoneNumber')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
          </div>
          <div class="form-group ">
              <input id="adrress" type="text" class="form-control @error('adrress') is-invalid @enderror" name="adrress" placeholder="Your Address"
                value="{{ old('adrress') }}" required autocomplete="adrress">

              @error('adrress')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
          </div>
          <div class="form-group">
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                name="password" required autocomplete="new-password">

              @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
          </div>

          <div class="form-group ">
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                autocomplete="new-password" placeholder="Confirm Password">
         
          </div>

          <div class="form-group ">
              <button type="submit"class="btn btn-secondary text-white submit px-3 form-control">
                {{ __('Register') }}
              </button>
          </div>
        </form>
         <p class="w-100 text-center">&mdash; Or Sign In &mdash;</p>
        <div class="social d-flex text-center">
          <a href="{{ route('login') }}" class="px-2 py-2 mr-md-1 rounded"><span
              class="ion-logo-facebook mr-2"></span>Sign In</a>
        </div>
      </div>
    </div>
  </div>
@endsection
