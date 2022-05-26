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
        <a class="step active" href="{{ route('user.choose.product') }}">
            <h4 class="step-title">2. {{__('Products choose option')}}:</h4>
        </a>
        <a class="step" href="{{ route('user.referal') }}">
          <h4 class="step-title">3. {{__('Referal ID')}}</h4>
        </a>
        <a class="step" href="{{ route('user.payment') }}">
          <h4 class="step-title">4. {{__('Payment option')}}</h4>
        </a>
      </div>
      <div class="card">
        <div class="card-body">
          <h6>{{__('Choose Product')}}</h6>
          <div class="row g-3" id="main_div">
              <div class="col-xxl-3 col-md-4 col-6">
                <div class="product-card ">
                  <div class="product-badge bg-danger"> New </div>

                  <div class="product-thumb">
                    <img class="lazy" alt="Product" src="https://localhost/farahtech/app/assets/images/ePfwBz9S.jpg" style="">
                    <div class="product-button-group">
                      <a class="product-button wishlist_store" href="https://localhost/farahtech/app/user/wishlist/store/592" title="Wishlist"><i class="icon-heart"></i></a>
                      <a class="product-button product_compare" href="javascript:;" data-target="https://localhost/farahtech/app/compare/product/592" title="Compare"><i class="icon-repeat"></i></a>
                      <a class="product-button" href="https://codecanyon.net/user/geniusdevs/portfolio" target="_blank" title="Buy Now"><i class="icon-arrow-right"></i></a>
                    </div>
                  </div>
                  <div class="product-card-body">
                    <div class="product-category">
                      <a href="https://localhost/farahtech/app/catalog?category=men-clothing">Men Clothing</a>
                    </div>
                    <h3 class="product-title"><a href="https://localhost/farahtech/app/product/Men-Polo-t-shirt">
                      Men Polo t-shirt
                    </a></h3>
                    <div class="rating-stars">
                      <i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
                    </div>
                    <h4 class="product-price">
                    $39.00
                    </h4>
                  </div>
                </div>
              </div>
              <div class="col-xxl-3 col-md-4 col-6">
                <div class="product-card ">
                  <div class="product-badge
                    bg-dark
                    "> Best
                  </div>
                  <div class="product-badge product-badge2 bg-info"> -33%</div>
                  <div class="product-thumb">
                    <img class="lazy" alt="Product" src="https://localhost/farahtech/app/assets/images/1634134144s9RH03667d1e3ae44be08f32b72d840db095J.jpg" style="">
                    <div class="product-button-group">
                      <a class="product-button wishlist_store" href="https://localhost/farahtech/app/user/wishlist/store/587" title="Wishlist"><i class="icon-heart"></i></a>
                      <a class="product-button product_compare" href="javascript:;" data-target="https://localhost/farahtech/app/compare/product/587" title="Compare"><i class="icon-repeat"></i></a>
                      <a class="product-button add_to_single_cart" data-target="587" href="javascript:;" title="To Cart"><i class="icon-shopping-cart"></i>
                      </a>
                    </div>
                  </div>
                  <div class="product-card-body">
                    <div class="product-category">
                      <a href="https://localhost/farahtech/app/catalog?category=Women-Clothing">Women Clothing</a>
                    </div>
                    <h3 class="product-title"><a href="https://localhost/farahtech/app/product/0AENew-French-Elegant-White-Bubble-Sleeve-Party-Dress-Casual-ALine-Dresses-Long-Sleeve-DressesnC">
                      New French Elegant White Bubble Sleeve
                    </a></h3>
                    <div class="rating-stars">
                      <i class="far fa-star filled"></i><i class="far fa-star filled"></i><i class="far fa-star filled"></i><i class="far fa-star filled"></i><i class="far fa-star filled"></i>
                    </div>
                    <h4 class="product-price">
                    <del>$500.78</del>
                    $344.83
                    </h4>
                  </div>
                </div>
              </div>
              <div class="col-xxl-3 col-md-4 col-6">
                <div class="product-card ">
                  <div class="product-badge
                    bg-warning
                    "> Feature
                  </div>

                  <div class="product-thumb">
                    <img class="lazy" alt="Product" src="https://localhost/farahtech/app/assets/images/1634134188F6gHTB1ymRhXfjsK1Rjy1Xaq6zispXad.jpg" style="">
                    <div class="product-button-group">
                      <a class="product-button wishlist_store" href="https://localhost/farahtech/app/user/wishlist/store/586" title="Wishlist"><i class="icon-heart"></i></a>
                      <a class="product-button product_compare" href="javascript:;" data-target="https://localhost/farahtech/app/compare/product/586" title="Compare"><i class="icon-repeat"></i></a>
                      <a class="product-button add_to_single_cart" data-target="586" href="javascript:;" title="To Cart"><i class="icon-shopping-cart"></i>
                      </a>
                    </div>
                  </div>
                  <div class="product-card-body">
                    <div class="product-category">
                      <a href="https://localhost/farahtech/app/catalog?category=Beauty--Personal-Care">Beauty &amp; Personal Care</a>
                    </div>
                    <h3 class="product-title"><a href="https://localhost/farahtech/app/product/Td5BREYLEE-facial-mask-hyaluronic-acid-facial-firming-mask-beautyca">
                      BREYLEE facial mask hyaluronic acid fa
                    </a></h3>
                    <div class="rating-stars">
                      <i class="far fa-star filled"></i><i class="far fa-star filled"></i><i class="far fa-star filled"></i><i class="far fa-star filled"></i><i class="far fa-star filled"></i>
                    </div>
                    <h4 class="product-price">
                    $1,362.81
                    </h4>
                  </div>
                </div>
              </div>
              <div class="col-xxl-3 col-md-4 col-6">
                <div class="product-card ">
                  <div class="product-badge
                    bg-danger
                    "> New
                  </div>

                  <div class="product-badge product-badge2 bg-info"> -29%</div>
                  <div class="product-thumb">
                    <img class="lazy" alt="Product" src="https://localhost/farahtech/app/assets/images/1634134210aEUHTB1K4CyX6DuK1Rjy1zjq6zraFXaj.jpg" style="">
                    <div class="product-button-group">
                      <a class="product-button wishlist_store" href="https://localhost/farahtech/app/user/wishlist/store/585" title="Wishlist"><i class="icon-heart"></i></a>
                      <a class="product-button product_compare" href="javascript:;" data-target="https://localhost/farahtech/app/compare/product/585" title="Compare"><i class="icon-repeat"></i></a>
                      <a class="product-button add_to_single_cart" data-target="585" href="javascript:;" title="To Cart"><i class="icon-shopping-cart"></i>
                      </a>
                    </div>
                  </div>
                  <div class="product-card-body">
                    <div class="product-category">
                      <a href="https://localhost/farahtech/app/catalog?category=Beauty--Personal-Care">Beauty &amp; Personal Care</a>
                    </div>
                    <h3 class="product-title"><a href="https://localhost/farahtech/app/product/p5lHome-Use-Beauty-Device-Face-Massager-Facial-Lifting-Tool-Beauty-AntiAgingbD">
                      Home Use Beauty Device Face Massager F
                    </a></h3>
                    <div class="rating-stars">
                      <i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
                    </div>
                    <h4 class="product-price">
                    <del>$1,893.26</del>
                    $1,362.81
                    </h4>
                  </div>
                </div>
              </div>
              <div class="col-12 text-center">
                    <button class="btn btn-primary margin-bottom-none" type="submit"><span>{{__('Next')}}</span></button>
                </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Site Footer-->
@endsection