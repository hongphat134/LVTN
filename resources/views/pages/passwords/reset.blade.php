@extends('layouts.master')
@section('content')
    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url({{ url('images/hero_1.jpg')}})" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Reset</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Reset</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mb-5">
            <h2 class="mb-4">Reset Password</h2>
            <form method="POST" action="{{ route('password.request') }}" class="p-4 border rounded">
            {{ csrf_field() }}
              <div class="row form-group">               
                <div class="col-md-12 mb-3 mb-md-0  {{ $errors->has('email') ? ' has-error' : '' }}">
                  <input type="hidden" name="token" value="{{ $token }}">
                  <label class="text-black" for="fname">Email</label>
                  <input type="email" id="fname" name="email" class="form-control" placeholder="Nhập địa chỉ Email..." value="{{ old('email') }}">
                  @if ($errors->has('email'))
                      <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0 {{ $errors->has('password') ? ' has-error' : '' }}">
                  <label class="text-black" for="fname">Password</label>
                  <input type="password" id="password" class="form-control" name="password" placeholder="Nhập Password....">
                  @if ($errors->has('password'))
                      <span class="help-block">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
              <div class="row form-group mb-4">
                <div class="col-md-12 mb-3 mb-md-0 {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                  <label class="text-black" for="fname">Nhập lại Password</label>
                  <input type="password" id="fname" name="password_confirmation" class="form-control" placeholder="Nhập lại Password....">
                  @if ($errors->has('password_confirmation'))
                      <span class="help-block">
                          <strong>{{ $errors->first('password_confirmation') }}</strong>
                      </span>
                  @endif
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Reset Password" class="btn px-4 btn-primary text-white">
                </div>
              </div>

            </form>
          </div>          
      </div>
    </section>
@endsection