{{-- @if (Auth::user()->status != 1 && empty(Auth::user()->referal_id) && empty($referal))

<script>window.location = "{{ route('user.referal') }}";</script>
      <?php exit; ?>
@endif --}}

@extends('master.front')
@section('title')
    {{__('Dashboard')}}
@endsection
@section('content')

<!-- Page Title-->
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumbs">
                    <li><a href="{{__('front.index')}}">{{__('Home')}}</a> </li>
                    <li class="separator"></li>
                    <li>{{__('Welcome Back')}} </li>
                  </ul>
            </div>
        </div>
    </div>
  </div>

  <!-- Page Content-->
  <div class="container padding-bottom-3x mb-1">
  <div class="row">
         @include('includes.user_sitebar')
         <div class="col-lg-8">
            <div class="padding-top-2x mt-2 hidden-lg-up"></div>
                <div class="row u-d-d">
                        @if (Auth::user()->status == 1)
                             <div class="col-md-6 mb-4">
                                <div class="card round">
                                    <div class="card-body text-center">
                                        <i class="icon-shopping-bag"></i>
                                        <p class="mt-3">{{__('Your Wallet')}}</p>
                                        <h5><b>{{ Auth::user()->points * 1.00 }}.00 SGD</b></h5>
                                        <a href="">Withdraw <i class="fa fa-angle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card round">
                                    <div class="card-body text-center">
                                        <i class="icon-shopping-bag"></i>
                                        <p class="mt-3">{{__('Your Points')}}</p>
                                        <h5><b> {{ Auth::user()->points ?? '0' }} </b></h5>
                                        <a href="">Convert to wallet <i class="fa fa-angle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card round">
                                    <div class="card-body text-center">
                                        <i class="icon-shopping-bag"></i>
                                        <p class="mt-3">{{__('All Order')}}</p>
                                        <h4><b>{{$allorders}}</b></h4>
                                    </div>
                                </div>
                            </div>
                            {{--<div class="col-md-6 mb-4">
                                <div class="card round">
                                    <div class="card-body text-center">
                                        <i class="icon-shopping-bag"></i>
                                        <p class="mt-3">{{__('Completed Order')}}</p>
                                        <h4><b>{{$delivered}}</b></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card round">
                                    <div class="card-body text-center">
                                        <i class="icon-shopping-bag"></i>
                                        <p class="mt-3">{{__('Processing Order')}}</p>
                                        <h4><b>{{$progress}}</b></h4>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6 mb-4">
                                <div class="card round">
                                    <div class="card-body text-center">
                                        <i class="icon-shopping-bag"></i>
                                        <p class="mt-3">{{__('Canceled Order')}}</p>
                                        <h4><b>{{$canceled}}</b></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card round">
                                    <div class="card-body text-center">
                                        <i class="icon-shopping-bag"></i>
                                        <p class="mt-3">{{__('Pending Order')}}</p>
                                        <h4><b>{{$pending}}</b></h4>
                                    </div>
                                </div>
                            </div>--}}
                            <div class="col-md-6 mb-4">
                                <div class="card round">
                                    <div class="card-body text-center">
                                        <i class="icon-shopping-bag"></i>
                                        <p class="mt-3">{{__('Refer User')}}</p>
                                        <h4><b>{{$users}}</b></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card round">
                                    <div class="card-body text-center">
                                        <i class="icon-shopping-bag"></i>
                                        <p class="mt-3">{{__('Refer Earnings (First level)')}}</p>
                                        <h4><b>{{ number_format($first_ref_earnings,2) }}</b></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card round">
                                    <div class="card-body text-center">
                                        <i class="icon-shopping-bag"></i>
                                        <p class="mt-3">{{__('Refer Earnings (Second level)')}}</p>
                                        <h4><b>{{ number_format($second_ref_earnings,2) }}</b></h4>
                                    </div>
                                </div>
                            </div>
                            @elseif (empty(Auth::user()->signup_product))
                                <div class="alert alert-success">
                                    <p>You are not choose any product.</p>
                                    <strong> Please choose a product to complete your registration.... </strong>
                                    <br>
                                    <br>
                                    <a href="{{route('user.choose.product')}}" class="btn btn-primay btn-sm">Click here</a>
                                </div>



                            @elseif (empty($referal)  && Auth::user()->referal_id == '')
                                <div class="alert alert-danger">
                                    <p>
                                        No referal id!!! Please mail Admin for Referal Id. A referal id will sent to you as soon as possiable.
                                        <span>Please complete your registration.... </span>
                                    <br>
                                    <br>
                                    <a href="{{route('user.referal')}}" class="btn btn-primay btn-sm">Click here</a>
                                    </p>
                                    {{-- {{ $referal->referal_email }} --}}
                                </div>
                            @elseif (isset($referal) && $referal->referal_email != '' && $referal->referal_id == '' && Auth::user()->referal_id == '')
                                <div class="alert alert-primary">
                                    <p>Your Email is sent. Please wait for admin response..</p>
                                </div>
                            @elseif (isset($referal) && $referal->referal_id != '' && empty(Auth::user()->referal_id))
                                <div class="alert alert-success">
                                    <p>A mail is sent to your email: {{ $referal->referal_email }}</p>
                                    <strong>Your Referal Id: <span class="badge badge-primary">{{$referal->referal_id}}</span> </strong>
                                    <span>Please complete your registration.... </span>
                                    <br>
                                    <br>
                                    <a href="{{route('user.referal')}}" class="btn btn-primay btn-sm">Click here</a>
                                </div>
                            @elseif (empty(Auth::user()->txn_id) && Auth::user()->referal_id != '')
                                <div class="alert alert-success">
                                    <p>You payment is not varified.</p>
                                    <strong> Please provide payment document to complete your registration.... </strong>
                                    <br>
                                    <br>
                                    <a href="{{route('user.payment')}}" class="btn btn-primay btn-sm">Click here</a>
                                </div>
                            @elseif (Auth::user()->referal_id != '')
                                <div class="alert alert-warning">
                                    <p>
                                        Your account is not active yet. We will make you active as soon as possiable.
                                    </p>
                                </div>
                        @endif
                    </div>
            </div>
        </div>
  </div>
@endsection
