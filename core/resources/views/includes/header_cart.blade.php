@php
    $total = 0;
    $qty = 0;
    $option_price = 0;
    $points = 0;
    $option_points = 0;
@endphp
@if (Session::has('cart'))
@foreach (Session::get('cart') as $key => $cart)
@php
    $total += ($cart['main_price'] + $total + $cart['attribute_price']) * $cart['qty'];
    $grandSubtotal = $total;
    $points += $cart['points'] * $cart['qty'];
    $option_points += $cart['attribute_points'];
    $grandPoints = $points + $option_points;
@endphp
<div class="entry">
  <div class="entry-thumb"><a href="{{route('front.product',$cart['slug'])}}"><img src="{{asset('assets/images/'.$cart['photo'])}}" alt="Product"></a></div>
  <div class="entry-content">
    <h4 class="entry-title"><a href="{{route('front.product',$cart['slug'])}}">
        {{ strlen(strip_tags($cart['name'])) > 35 ? substr(strip_tags($cart['name']), 0, 35) . '...' : strip_tags($cart['name']) }}
    </a></h4>
    <span class="entry-meta">{{$cart['qty']}} x {{PriceHelper::setCurrencyPrice($cart['main_price'])}}</span>

 </div>
  <div class="entry-delete"><a href="{{route('front.cart.destroy',$key)}}"><i class="icon-x"></i></a></div>
</div>
@endforeach
<div class="text-right">
<p class="text-gray-dark py-2 mb-0"><span class="text-muted">{{__('Subtotal')}}:</span> {{PriceHelper::setCurrencyPrice($grandSubtotal)}}</p>
<p class="text-gray-dark py-2 mb-0"><span class="text-muted">{{__('Points')}}:</span> {{$grandPoints}}</p>
</div>
<div class="d-flex justify-content-between">
<div class="w-50 d-block"><a class="btn btn-primary btn-sm  mb-0" href="{{route('front.cart')}}"><span>{{__('Cart')}}</span></a></div>
<div class="w-50 d-block text-end"><a class="btn btn-primary btn-sm  mb-0" href="{{route('front.checkout.billing')}}"><span>{{__('Checkout')}}</span></a></div>
@else
{{__('Cart empty')}}
  @endif
</div>
