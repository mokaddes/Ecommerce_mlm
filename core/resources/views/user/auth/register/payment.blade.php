@extends('master.front')
@section('title')
{{__('register')}}
@endsection
@section('content')
<style>
.payment-methods .single-payment-method {
margin: 21px auto;
}
.form-control{
    padding: 10px 18px;
}
@media screen and (max-width: 576px){
    .payment-methods .single-payment-method {
        width: 100%;
    }
}
</style>
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
                <a class="step" href="{{ route('user.referal') }}">
                    <h4 class="step-title">3. {{__('Referal ID')}}</h4>
                </a>
                <a class="step active" href="{{ route('user.payment') }}">
                    <h4 class="step-title">4. {{__('Payment option')}}</h4>
                </a>
            </div>
            <div class="card">
                <div class="card-body">
                    <h6>{{__('Payment option')}}</h6>
                    <div class="card register-area">
                            <div class="card-body">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-12 mb-3 text-center">
                                        {{ $qrcode }}
                                    </div>
                                    <div class="col-sm-7 col-lg-5">
                                        <form action=" {{ route('user.payment.submit') }} " method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="col-lg-12 form-group">
                                                <label for="transaction">Transaction Number</label>
                                                <input class="form-control" name="txn_id" id="transaction" placeholder="Enter Your Transaction Number" >
                                                @error('txn_id')
                                                    <p class="text-danger">{{$message}}</p>
                                                @endif
                                            </div>
                                            <div class="col-lg-12 form-group">
                                                <label for="transaction">Payment Proof Photo</label>
                                                <input type="file" class="form-control" name="txn_pic" id="" required="">

                                            </div>
                                            <div class="col-12 text-center">
                                                <button class="btn btn-primary btn-sm" type="button" data-bs-dismiss="modal">Cancel</button>
                                                <button class="btn btn-primary btn-sm" type="submit"><span>Checkout With Bank Transfer</span></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>
@endsection