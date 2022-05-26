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
				@if (Session::has('register'))
				<a class="step " href="{{ route('user.choose.product') }}">
					<h4 class="step-title">2. {{__('Products')}}:</h4>
				</a>
				@else
				<a class="step " href="#">
					<h4 class="step-title">2. {{__('Products')}}:</h4>
				</a>
				@endif
				<a class="step active" href="{{ route('user.shipping.address') }}">
					<h4 class="step-title">3. {{__('Shipping Address')}}:</h4>
				</a>
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
					<h6>{{__('Shipping Address')}}</h6>
					<div class="card">
						<div class="card-body">
							<form id="checkoutShipping" action="{{route('user.shipping_submit')}}" method="POST">
								@csrf
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="checkout-fn">{{__('First Name')}}</label>
											<input class="form-control" name="first_name" type="text" id="checkout-fn" value="{{isset($user) ? $user->first_name : ''}}" readonly>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="checkout-ln">{{__('Last Name')}}</label>
											<input class="form-control" name="last_name" type="text" id="checkout-ln" value="{{isset($user) ? $user->last_name : ''}}" readonly>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="checkout-email">{{__('E-mail Address')}}</label>
											<input class="form-control" name="email" type="email" id="checkout-email" value="{{isset($user) ? $user->email : ''}}" readonly>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="checkout-phone">{{__('Phone Number')}}</label>
											<input class="form-control" name="phone" type="text" id="checkout-phone" value="{{isset($user) ? $user->phone : ''}}" readonly>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<label for="checkout-company">{{__('Company')}}</label>
											<input class="form-control" name="ship_company" type="text" id="checkout-company" value="{{isset($user) ? $user->ship_company : ''}}">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="checkout-address1">{{__('Address')}} 1</label>
											<input class="form-control" name="ship_address1" required type="text" id="checkout-address1" value="{{isset($user) ? $user->ship_address1 : ''}}" >
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="checkout-address2">{{__('Address')}} 2</label>
											<input class="form-control" name="ship_address2" type="text" id="checkout-address2" value="{{isset($user) ? $user->ship_address2 : ''}}">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="checkout-zip">{{__('Zip Code')}}</label>
											<input class="form-control" name="ship_zip" type="text" id="checkout-zip" value="{{isset($user) ? $user->ship_zip : ''}}" >
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="checkout-city">{{__('City')}}</label>
											<input class="form-control" name="ship_city" required type="text" id="checkout-city" value="{{isset($user) ? $user->ship_city : ''}}" >
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<label for="checkout-country">{{ __('Country') }}</label>
											<select class="form-control" name="ship_country" required id="billing-country">
												<option selected>{{__('Choose Country')}}</option>
												@foreach (DB::table('countries')->get() as $country)
												<option value="{{$country->name}}" {{isset($user) && $user->ship_country == $country->name ? 'selected' :''}} >{{$country->name}}</option>
												@endforeach
											</select>
										</div>
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
</div>
<!-- Site Footer-->
@endsection