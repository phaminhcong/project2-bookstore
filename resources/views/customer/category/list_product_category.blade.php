@extends('customer.customer')
@section('content')
<section class="hero-area hero-slider-1 section-margin">
    <div class="sb-slick-slider" data-slick-setting='{
                            "autoplay": true,
                            "fade": true,
                            "autoplaySpeed": 3000,
                            "speed": 3000,
                            "slidesToShow": 1,
                            "dots":true
                            }'>
        <div class="single-slide bg-ghost-white">
            <div class="container">
                <div class="home-content text-center text-sm-left position-relative">
                    <div class="hero-partial-image image-left">
                        <img src="{{ asset ('htmldemo.net/image/bg-images/banner_manga.jpg') }}"  alt="">
                    </div>
                    <div class="row align-items-center justify-content-start justify-content-md-end">
                        <div class="col-lg-6 col-xl-7 col-md-6 col-sm-7">
                            <div class="home-content-inner content-right-side text-start">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-padding">
    <h2 class="sr-only">Home Tab Slider Section</h2>
    <div class="container-fluid">
        <div class="sb-custom-tab">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane show active" id="shop" role="tabpanel" aria-labelledby="shop-tab">
                    <div class="product-slider multiple-row  slider-border-multiple-row  sb-slick-slider" data-slick-setting='{
                            "autoplay": true,
                            "autoplaySpeed": 8000,
                            "slidesToShow": 4,
                            "rows": {{$productsDividedByFour}},
                            "dots":true
                        }' data-slick-responsive='[
                            {"breakpoint":1200, "settings": {"slidesToShow": 3} },
                            {"breakpoint":768, "settings": {"slidesToShow": 2} },
                            {"breakpoint":480, "settings": {"slidesToShow": 1} },
                            {"breakpoint":320, "settings": {"slidesToShow": 1} }
                        ]'>
                        @foreach ( $products as $row )
                        <div class="single-slide">
                            <div class="product-card">
                                <div class="product-header">
                                    <h3><a href="{{route('product.product-detail', ['id' => $row->id])}}">{{$row -> name}}</a></h3>
                                </div>
                                <div class="product-card--body">
                                    <div class="card-image">
                                        <img src="{{ asset ('dist/img/'.$row -> image_product) }}" alt="" style="height: 270px; width:190px; margin-left: auto; margin-right: auto;">
                                        <div class="hover-contents">
                                            <a href="{{route('product.product-detail', ['id' => $row->id])}}" class="hover-image">
                                                <img src="{{ asset ('dist/img/'.$row -> image_product) }}" alt="" style="height: 270px; width:190px; margin-left: auto; margin-right: auto;">
                                            </a>
                                            <div class="hover-btns">
                                                <form action="{{ route('cart.add', $row->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="single-btn">
                                                        <i class="fas fa-shopping-basket"></i>
                                                    </button>
                                                </form>
                                                <a href="compare.html" class="single-btn">
                                                    <i class="fas fa-random"></i>
                                                </a>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#quickModal" class="single-btn">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="price-block">
                                        <span class="price">{{ $row->price - ($row->price * $row->sale / 100) }} VND</span>
                                        @if ($row->sale > 0)
                                        <del class="price-old">{{$row -> price}} VND</del>
                                        @endif
                                        @if ($row->sale > 0)
                                        <span class="price-discount">{{$row -> sale}} %</span>
                                        @endif
                                    </div>
                                    <div>
                                        Đã bán: 3 sản phẩm
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                </div>
                
                
        </div>
    </div>
</section>
@endsection