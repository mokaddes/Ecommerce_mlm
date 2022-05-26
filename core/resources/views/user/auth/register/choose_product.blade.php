@extends('master.front')
@section('title')
{{__('register')}}
@endsection
@section('content')
    @php
        function renderStarRating($rating,$maxRating=5) {

            $fullStar = "<i class = 'far fa-star filled'></i>";
            $halfStar = "<i class = 'far fa-star-half filled'></i>";
            $emptyStar = "<i class = 'far fa-star'></i>";
            $rating = $rating <= $maxRating?$rating:$maxRating;

            $fullStarCount = (int)$rating;
            $halfStarCount = ceil($rating)-$fullStarCount;
            $emptyStarCount = $maxRating -$fullStarCount-$halfStarCount;

            $html = str_repeat($fullStar,$fullStarCount);
            $html .= str_repeat($halfStar,$halfStarCount);
            $html .= str_repeat($emptyStar,$emptyStarCount);
            $html = $html;
            return $html;
        }

        // $last_user = DB::table('users')->last();
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
            <a class="step active" href="{{ route('user.choose.product') }}">
                <h4 class="step-title">2. {{__('Products choose option')}}:</h4>
            </a>
        @else
            <a class="step active" href="">
                <h4 class="step-title">2. {{__('Products choose option')}}:</h4>
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
          </div>
        <div class="card-body">
          <h6>{{__('Choose Product')}}</h6>

          <div class="row g-3" id="main_div">
              @foreach ($products as $item)
              <div class="col-xxl-4 col-md-4 col-sm-4 col-xs-12">
                <div class="product-card ">
                  {{-- <div class="product-badge bg-danger">
                    @if($item->is_type == 'feature')
                        Feature
                    @elseif($item->is_type == 'new')
                        New
                    @elseif($item->is_type == 'top')
                        Top
                    @elseif($item->is_type == 'best')
                        Best
                    @elseif($item->is_type == 'flash_deal')
                        Flash
                    @endif
                  </div> --}}

                  <div class="product-thumb">
                    <img class="lazy" alt="Product" src="{{asset('assets/images/'.$item->photo)}}">
                    {{-- <div class="product-button-group">
                      <a class="product-button wishlist_store" href="{{ route('user.wishlist.store', $item->id) }}" title="Wishlist"><i class="icon-heart"></i></a>
                      <a class="product-button product_compare" href="javascript:;" data-target="{{route('fornt.compare.product',$item->id)}}" title="Compare"><i class="icon-repeat"></i></a>
                      <a class="product-button" href="{{$item->affiliate_link}}"  title="Buy Now"><i class="icon-arrow-right"></i></a>
                    </div> --}}
                  </div>
                  <div class="product-card-body">
                    <div class="product-category">
                            <a href="https://localhost/farahtech/app/catalog?category=men-clothing">{{$item->category->name}}</a>

                    </div>
                    <div class="rating-stars mb-4">
                        <h3 class="product-title"><a href="{{ route('front.product', $item->slug) }}">
                            {{$item->name}}
                        </a></h3>
                    </div>
                    {{-- <div class="rating-stars mt-4">
                        {!!renderStarRating($item->reviews->avg('rating'))!!}
                    </div> --}}
                    {{-- <h4 class="product-price">
                        @if ($item->discount_price != '')
                            {{ $item->discount_price }}
                        @else
                            {{ $item->previous_price }}
                        @endif
                    </h4>
                    <br> --}}
                    <form action="{{route('user.product.submit')}}" method="post" class="mt-10">
                        @csrf
                        <label for="signup_product_{{$item->id}}" style="cursor: pointer"><input type="radio" name="signup_product[]" id="signup_product_{{$item->id}}" value="{{$item->id}}"> Select any one</label>
                        @error('signup_product')
                            <p class="text-danger">{{$message}}</p>
                        @endif
                  </div>
                </div>
              </div>

              @endforeach

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
<!-- Site Footer-->
@endsection