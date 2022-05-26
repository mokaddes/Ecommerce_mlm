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
           <a class="step" href="{{ route('user.register') }}">
               <h4 class="step-title">1. {{__('Register')}}:</h4>
            </a>
            <a class="step" href="{{ route('user.choose.product') }}">
               <h4 class="step-title">2. {{__('Products choose option')}}:</h4>
            </a>
            <a class="step " href="{{ route('user.shipping.address') }}">
                <h4 class="step-title">3. {{__('Shipping Address')}}:</h4>
            </a>
            <a class="step active" href="{{ route('user.referal') }}">
              <h4 class="step-title">3. {{__('Referal ID')}}</h4>
            </a>
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
            <div class="card-header">
                @if ($m = Session::get('warning'))
                    <div class="alert alert-danger">
                        {{$m}}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="card-body">
                  <h6>{{__('Referal ID')}}</h6>
                  <div class="card register-area">
                        <div class="card-body">
                            <div class="row d-flex justify-content-center">
                                <div class="col-sm-7 col-lg-5">
                                    <form id="" action=" {{route('user.referal.submit')}} " method="POST">
                                          @csrf
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="reg-fn">{{__('Referal ID')}}</label>
                                                <input class="form-control" type="text" name="referal_id" placeholder="" id=""  >
                                                @error('referal_id')
                                                    <p class="text-danger">{{$message}}</p>
                                                @endif
                                            </div>
                                            <div class="mb-3">
                                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#bank">Don't have referal id send mail admin to get ID.</a>
                                            </div>
                                        </div>
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

        <!-- modal -->
        <div class="modal fade" id="bank" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title">Request to admin for referal ID</h6>
                        <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <form action=" {{ route('user.referal.mail') }} " method="POST">
                        @csrf
                        <div class="modal-body">
                            @if (Auth::user())
                                <div class="col-lg-12 form-group">
                                    <label for="transaction">Email</label>
                                    <input type="email" class="form-control" name="referal_email" id="" value=" {{ Auth::user()->email }} " readonly required>
                                    @error('referal_email')
                                        <p class="text-danger">{{$message}}</p>
                                    @endif
                                </div>
                            @elseif (empty(Auth::user()) && Session::has('register'))
                                <div class="col-lg-12 form-group">
                                    <label for="transaction">Email</label>
                                    <input type="email" class="form-control" name="referal_email" id="" value=" {{ $user->email }} " readonly required>
                                    @error('referal_email')
                                        <p class="text-danger">{{$message}}</p>
                                    @endif
                                </div>
                            @else
                                <div class="col-lg-12 form-group">
                                    <label for="transaction">Email</label>
                                    <input type="email" class="form-control" name="referal_email" id="" placeholder="Enter your email" required >
                                    @error('referal_email')
                                        <p class="text-danger">{{$message}}</p>
                                    @endif
                                </div>
                            @endif
                            <div class="col-lg-12 form-group">
                                <label for="transaction">Special Request</label>
                                <textarea name="referal_message" id="" class="form-control" placeholder="Enter your speical request message" required></textarea>
                                @error('referal_message')
                                    <p class="text-danger">{{$message}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary btn-sm" type="button" data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary btn-sm" type="submit"><span>Send</span></button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>

      </div>
    </div>
  </div>
  <!-- Site Footer-->
@endsection
