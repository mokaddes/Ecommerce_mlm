@extends('master.front')
@section('title')
    {{__('Login')}}
@endsection
@section('content')

    <!-- Page Title-->
<div class="page-title">
    <div class="container">
      <div class="row">
          <div class="col-lg-12">
            <ul class="breadcrumbs">
                <li><a href="{{route('front.index')}}">{{__('Home')}}</a> </li>
                <li class="separator"></li>
                <li>{{__('Login/Register')}}</li>
              </ul>
          </div>
      </div>
    </div>
  </div>
  <!-- Page Content-->
  <div class="container padding-bottom-3x mb-1">
  <div class="row d-flex justify-content-center">
          <div class="col-sm-8 col-md-6 col-lg-5">
            <form class="card" method="post" action="{{route('user.login.submit')}}">
                @csrf
              <div class="card-body ">
                <h4 class="margin-bottom-1x text-center">{{__('Login')}}</h4>

                <div class="form-group input-group">
                  <input class="form-control" type="email" name="login_email" placeholder="{{ __('Email') }}" value="{{old('login_email')}}"><span class="input-group-addon"><i class="icon-mail"></i></span>
                </div>
                 @error('login_email')
                   <p class="text-danger">{{$message}}</p>
                 @enderror

                <div class="form-group input-group">
                  <input class="form-control" type="password" name="login_password" placeholder="{{ __('Password') }}" ><span class="input-group-addon"><i class="icon-lock"></i></span>
                </div>
                @error('login_password')
                    <p class="text-danger">{{$message}}</p>
                @enderror
                <div class="d-flex flex-wrap justify-content-between padding-bottom-1x">
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="remember_me">
                        <label class="custom-control-label" for="remember_me">{{__('Remember me')}}</label>
                    </div><a class="navi-link" href="{{route('user.forgot')}}">{{__('Forgot password?')}}</a>
                </div>
                  <div class="text-center">
                      <button class="btn btn-primary margin-bottom-none" type="submit"><span>{{ __('Login') }}</span></button>
                  </div>
                  <div class="text-center mt-3">
                    <span>Not a member? <a href="{{route('user.register')}}">Sign Up</a></span>
                </div>
              </div>
            </form>
          </div>
        </div>
  </div>
  <!-- Site Footer-->
@endsection
