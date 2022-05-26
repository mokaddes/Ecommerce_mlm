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
           <a class="step" href="{{ route('user.register') }}">
               <h4 class="step-title">1. {{__('Register')}}:</h4>
            </a>
            <a class="step" href="{{ route('user.choose.product') }}">
               <h4 class="step-title">2. {{__('Products choose option')}}:</h4>
            </a>
            <a class="step active" href="{{ route('user.referal') }}">
              <h4 class="step-title">3. {{__('Referal ID')}}</h4>
            </a>
            <a class="step" href="{{ route('user.payment') }}">
              <h4 class="step-title">4. {{__('Payment option')}}</h4>
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                  <h6>{{__('Referal ID')}}</h6>
                  <div class="card register-area">
                        <div class="card-body">
                            <div class="row d-flex justify-content-center">
                                <div class="col-sm-7 col-lg-5">
                                    <form id="" action="" method="POST">
                                          @csrf
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="reg-fn">{{__('Referal ID')}}</label>
                                                <input class="form-control" type="text" name="" placeholder="" id="" value="">
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
                        <h6 class="modal-title">Send mail to get Referal ID</h6>
                        <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <form action="" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="col-lg-12 form-group">
                                <label for="transaction">Email</label>
                                <input type="email" class="form-control" name="" id="" placeholder="Enter your email" required="">
                            </div>
                            <div class="col-lg-12 form-group">
                                <label for="transaction">Special Request</label>
                                <textarea name="" id="" class="form-control" placeholder="Enter your speical request message"></textarea>
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
