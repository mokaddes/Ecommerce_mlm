{{-- @if (Auth::user())
<script>window.location = "{{ route('user.dashboard') }}";</script>
<?php exit; ?>
@endif --}}
@extends('master.front')
@section('title')
{{__('register')}}
@endsection
@section('content')
@php
if (Session::has('register')) {
$id = Session::get('register');
$user = DB::table('users')->where('id', $id)->first();
}
@endphp
<!-- Page Title-->
<style>
    .card.register_benefit h5 {border-bottom: 1px solid #EEE;padding-bottom: 8px;font-size: 16px;color: #333;font-weight: 500;}
    .card-body ul li {font-size: 14px;color: #555;padding: 6px 0px;}
</style>
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
    <div class="row">
        <div class="col-xl-3 order-xl-2 mb-5">
            <div class="card register_benefit">
                <div class="card-body">
                    <h5>Sign up as new member today for just <strong>SGD17/RM 50</strong> and get the following benefit</h5>
                    <ul>
                        <li>CHOICE ON 1 E-BOOK</li>
                        <li>DIRECT REFERRAL 20% PER ACCTOUNT</li>
                        <li>EARN MONTHLY REWARDS POINTS 15- 50 PTS </li>
                         <li>2ND LEVEL INDIRECT REFERAL 10% PER ACCT</li>
                        <li>DISCOUNTED PRICE ON SELECTED PRODUCTS ONLINE</li>
                        <li>FREE POWER ECHANCMENT CARD VALUE AT SGD 27 PER CARD</li>
                        <li>LUCKY DRAW AWAITS FOR ANYONE WHO SIGN UP IN THE FIRST 2 MONTHS</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-9 order-xl-1">
            <div class="steps flex-sm-nowrap mb-5">
                <a class="step active" href="{{ route('user.register') }}">
                    <h4 class="step-title">1. {{__('Register')}}:</h4>
                </a>
                @if (Session::has('register'))
                <a class="step " href="{{ route('user.choose.product') }}">
                    <h4 class="step-title">2. {{__('Products')}}:</h4>
                </a>
                @else
                <a class="step " href="#">
                    <h4 class="step-title">2. {{__('Products')}}:</h4>
                </a>
                @endif
                @if (Session::has('choose') && Session::has('register'))
                    <a class="step " href="{{ route('user.shipping.address') }}">
                        <h4 class="step-title">3. {{__('Shipping Address')}}:</h4>
                    </a>
                @else
                    <a class="step " href="#">
                        <h4 class="step-title">3. {{__('Shipping Address')}}:</h4>
                    </a>
                @endif
                @if (Session::has('shipping_address'))
                    <a class="step" href="{{ route('user.referal') }}">
                        <h4 class="step-title">3. {{__('Referal ID')}}</h4>
                    </a>
                @else
                    <a class="step" href="#">
                        <h4 class="step-title">3. {{__('Referal ID')}}</h4>
                    </a>
                @endif
                @if (Session::has('referal') && Session::has('register'))
                <a class="step" href="{{ route('user.payment') }}">
                    <h4 class="step-title">5. {{__('Payment')}}</h4>
                </a>
                @else
                <a class="step" href="#">
                    <h4 class="step-title">5. {{__('Payment')}}</h4>
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
                                        <input class="form-control" type="text" name="first_name" placeholder="{{__('First Name')}}" id="reg-fn" value="{{$user->first_name ?? ''}}">
                                        @error('first_name')
                                        <p class="text-danger">{{$message}}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="reg-ln">{{__('Last Name')}}</label>
                                        <input class="form-control" type="text" name="last_name" placeholder="{{__('Last Name')}}" id="reg-ln" value="{{$user->last_name ?? ''}}">
                                        @error('last_name')
                                        <p class="text-danger">{{$message}}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="reg-email">{{__('E-mail Address')}}</label>
                                        <input class="form-control" type="email" name="email" placeholder="{{__('E-mail Address')}}" id="reg-email" value="{{$user->email ?? ''}}">
                                        @error('email')
                                        <p class="text-danger">{{$message}}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="reg-phone">{{__('Phone Number')}}</label>
                                        <input class="form-control" name="phone" type="text" placeholder="{{__('Phone Number')}}" id="reg-phone" value="{{$user->phone ?? ''}}">
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