@extends('master.front')
@section('title')
    {{__('register')}}
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
                <li>{{__('Register')}}</li>
              </ul>
          </div>
      </div>
    </div>
  </div>
  <!-- Page Content-->
  <div class="container padding-bottom-3x mb-1">
    <div class="row d-flex justify-content-center">
      <div class="col-xl-10 col-lg-11">
        <div class="steps flex-sm-nowrap mb-5">
           <a class="step active" href="{{ route('user.register') }}">
               <h4 class="step-title">1. {{__('Register')}}:</h4>
            </a>
            @if (Session::has('register'))
                <a class="step " href="{{ route('user.choose.product') }}">
                    <h4 class="step-title">2. {{__('Products choose option')}}:</h4>
                </a>
            @else
                <a class="step " href="#">
                    <h4 class="step-title">2. {{__('Products choose option')}}:</h4>
                </a>
            @endif
            @if (Session::has('choose'))
                <a class="step" href="{{ route('user.referal') }}">
                    <h4 class="step-title">3. {{__('Referal ID')}}</h4>
                </a>
            @else
                <a class="step" href="#">
                    <h4 class="step-title">3. {{__('Referal ID')}}</h4>
                </a>
            @endif

            @if (Session::has('referal'))
                <a class="step" href="{{ route('user.payment') }}">
                    <h4 class="step-title">4. {{__('Payment option')}}</h4>
                </a>
            @else
                <a class="step" href="#">
                    <h4 class="step-title">4. {{__('Payment option')}}</h4>
                </a>
            @endif


        </div>

        <div class="card">
            <div class="card-body">
                  <h6>{{__('Register')}}</h6>
                  <div class="card register-area">
                        <div class="card-body">
                              <form id="checkoutBilling" class="row" action="{{route('user.register.submit')}}" method="POST">
                                  @csrf
                                  <input type="hidden" name="part" value="register">
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label for="reg-fn">{{__('First Name')}}</label>
                                    <input class="form-control" type="text" name="first_name" placeholder="{{__('First Name')}}" id="reg-fn" value="{{old('first_name')}}">
                                  @error('first_name')
                                  <p class="text-danger">{{$message}}</p>
                                  @endif
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label for="reg-ln">{{__('Last Name')}}</label>
                                    <input class="form-control" type="text" name="last_name" placeholder="{{__('Last Name')}}" id="reg-ln" value="{{old('last_name')}}">
                                    @error('last_name')
                                  <p class="text-danger">{{$message}}</p>
                                  @endif
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label for="reg-email">{{__('E-mail Address')}}</label>
                                    <input class="form-control" type="email" name="email" placeholder="{{__('E-mail Address')}}" id="reg-email" value="{{old('email')}}">
                                    @error('email')
                                    <p class="text-danger">{{$message}}</p>
                                    @endif
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label for="reg-phone">{{__('Phone Number')}}</label>
                                    <input class="form-control" name="phone" type="text" placeholder="{{__('Phone Number')}}" id="reg-phone" value="{{old('phone')}}">
                                    @error('phone')
                                    <p class="text-danger">{{$message}}</p>
                                    @endif
                                  </div>
                                </div>

                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label for="reg-pass">{{__('Password')}}</label>
                                    <input class="form-control" type="password" name="password" placeholder="{{__('Password')}}" id="reg-pass">
                                    @error('password')
                                    <p class="text-danger">{{$message}}</p>
                                    @endif
                                  </div>

                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label for="reg-pass-confirm">{{__('Confirm Password')}}</label>
                                    <input class="form-control" type="password" name="password_confirmation" placeholder="{{__('Confirm Password')}}" id="reg-pass-confirm">
                                  </div>
                                </div>

                                @if ($setting->recaptcha == 1)
                                    <div class="col-lg-12 mb-4">
                                        {!! NoCaptcha::renderJs() !!}
                                        {!! NoCaptcha::display() !!}
                                        @if ($errors->has('g-recaptcha-response'))
                                        @php
                                            $errmsg = $errors->first('g-recaptcha-response');
                                        @endphp
                                        <p class="text-danger mb-0">{{__("$errmsg")}}</p>
                                        @endif
                                    </div>
                                @endif

                                <div class="col-12 text-center">
                                  <button class="btn btn-primary margin-bottom-none" type="submit"><span>{{__('Next')}}</span></button>
                                </div>
                          </form>
                      </div>
                  </div>
            </div>
        </div>

      </div>
    </div>
  </div>
  <!-- Site Footer-->
@endsection
