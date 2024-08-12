@extends('customer.customer')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<section class="hero-area hero-slider-1">
    <div class="sb-slick-slider" data-slick-setting='{
                            "autoplay": true,
                            "fade": true,
                            "autoplaySpeed": 3000,
                            "speed": 3000,
                            "slidesToShow": 1,
                            "dots":true
                            }'>
        <div class="single-slide bg-shade-whisper  ">
            <div class="container">
                <div class="home-content text-center text-sm-left position-relative">
                    <div class="hero-partial-image image-right">
                        <img src="{{ asset ('htmldemo.net/image/bg-images/home-slider-2-ai.png')}}" alt="">
                    </div>
                    <div class="row g-0">
                        <div class="col-xl-6 col-md-6 col-sm-7">
                            <div class="home-content-inner content-left-side text-start">
                                <h1> Phạm Minh<br>
                                    Công</h1>
                                <h2>Sản phẩm luôn chất lượng và chính hãng</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="single-slide bg-ghost-white">
            <div class="container">
                <div class="home-content text-center text-sm-left position-relative">
                    <div class="hero-partial-image image-left">
                        <img src="{{ asset ('htmldemo.net/image/bg-images/banner_manga.jpg') }}" alt="">
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
<!--=================================
        Home Features Section
        ===================================== -->
<section class="mb--30">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-md-6 mt--30">
                <div class="feature-box h-100">
                    <div class="icon">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <div class="text">
                        <h5>Free Shipping Item</h5>
                        <p> Orders over $500</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mt--30">
                <div class="feature-box h-100">
                    <div class="icon">
                        <i class="fas fa-redo-alt"></i>
                    </div>
                    <div class="text">
                        <h5>Money Back Guarantee</h5>
                        <p>100% money back</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mt--30">
                <div class="feature-box h-100">
                    <div class="icon">
                        <i class="fas fa-piggy-bank"></i>
                    </div>
                    <div class="text">
                        <h5>Cash On Delivery</h5>
                        <p>Lorem ipsum dolor amet</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mt--30">
                <div class="feature-box h-100">
                    <div class="icon">
                        <i class="fas fa-life-ring"></i>
                    </div>
                    <div class="text">
                        <h5>Help & Support</h5>
                        <p>Call us : + 0123.4567.89</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=================================
        Promotion Section One
        ===================================== -->

<section class="section-margin">
    <h2 class="sr-only">Promotion Section</h2>
    <div class="container">
        <div class="row space-db--30">
            <div class="col-lg-6 col-md-6 mb--30">
                <a href="#" class="promo-image promo-overlay">
                    <img src="{{ asset ('htmldemo.net/image/bg-images/promo-banner-with-text.jpg')}}" alt="">
                </a>
            </div>
            <div class="col-lg-6 col-md-6 mb--30">
                <a href="#" class="promo-image promo-overlay">
                    <img src="{{ asset ('htmldemo.net/image/bg-images/promo-banner-with-text-2.jpg')}}" alt="">
                </a>
            </div>
        </div>
    </div>
</section>
<!--=================================
        Home Slider Tab
        ===================================== -->
<section class="section-padding">
    <h2 class="sr-only">Home Tab Slider Section</h2>
    <div class="container-fluid">
        <div class="sb-custom-tab">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="shop-tab" data-bs-toggle="tab" href="#shop" role="tab" aria-controls="shop" aria-selected="true">
                        Sản phẩm nổi bật
                    </a>
                    <span class="arrow-icon"></span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="men-tab" data-bs-toggle="tab" href="#men" role="tab" aria-controls="men" aria-selected="true">
                        Sản phẩm mới
                    </a>
                    <span class="arrow-icon"></span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="woman-tab" data-bs-toggle="tab" href="#woman" role="tab" aria-controls="woman" aria-selected="false">
                        Sản phẩm được mua nhiều
                    </a>
                    <span class="arrow-icon"></span>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane show active" id="shop" role="tabpanel" aria-labelledby="shop-tab">
                    <div class="product-slider multiple-row  slider-border-multiple-row  sb-slick-slider" data-slick-setting='{
                            "autoplay": true,
                            "autoplaySpeed": 8000,
                            "slidesToShow": 5,
                            "rows":2,
                            "dots":true
                        }' data-slick-responsive='[
                            {"breakpoint":1200, "settings": {"slidesToShow": 3} },
                            {"breakpoint":768, "settings": {"slidesToShow": 2} },
                            {"breakpoint":480, "settings": {"slidesToShow": 1} },
                            {"breakpoint":320, "settings": {"slidesToShow": 1} }
                        ]'>
                        @foreach ( $data1 as $row )
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
                                                <button type="button" class="single-btn quick_view" data-bs-toggle="modal" data-bs-target="#quickModal" id="{{$row->id}}">
                                                <i class="fas fa-eye"></i>
                                                </button>
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
                                    
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
                <div class="tab-pane" id="men" role="tabpanel" aria-labelledby="men-tab">
                    <div class="product-slider multiple-row  slider-border-multiple-row  sb-slick-slider" data-slick-setting='{
                                        "autoplay": true,
                                        "autoplaySpeed": 8000,
                                        "slidesToShow": 5,
                                        "rows":2,
                                        "dots":true
                                    }' data-slick-responsive='[
                                        {"breakpoint":1200, "settings": {"slidesToShow": 3} },
                                        {"breakpoint":768, "settings": {"slidesToShow": 2} },
                                        {"breakpoint":480, "settings": {"slidesToShow": 1} },
                                        {"breakpoint":320, "settings": {"slidesToShow": 1} }
                                    ]'>
                        @foreach ( $data2 as $row )
                        <div class="single-slide">
                            <div class="product-card">
                                <div class="product-header">
                                    <a href="#" class="author">
                                        {{$row -> name}}
                                    </a>
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
                                                <button type="button" class="single-btn quick_view" data-bs-toggle="modal" data-bs-target="#quickModal" id="{{$row->id}}">
                                                <i class="fas fa-eye"></i>
                                                </button>
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
                                    
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
                <div class="tab-pane" id="woman" role="tabpanel" aria-labelledby="woman-tab">
                    <div class="product-slider multiple-row  slider-border-multiple-row  sb-slick-slider" data-slick-setting='{
                                        "autoplay": true,
                                        "autoplaySpeed": 8000,
                                        "slidesToShow": 5,
                                        "rows":2,
                                        "dots":true
                                    }' data-slick-responsive='[
                                        {"breakpoint":1200, "settings": {"slidesToShow": 3} },
                                        {"breakpoint":768, "settings": {"slidesToShow": 2} },
                                        {"breakpoint":480, "settings": {"slidesToShow": 1} },
                                        {"breakpoint":320, "settings": {"slidesToShow": 1} }
                                    ]'>
                                    @foreach ( $data3 as $row1 )
                        <div class="single-slide">
                            <div class="product-card">
                                <div class="product-header">
                                    <a href="#" class="author">
                                        {{$row1 -> name}}
                                    </a>
                                    <h3><a href="{{route('product.product-detail', ['id' => $row->id])}}">{{$row1 -> name}}</a></h3>
                                </div>
                                <div class="product-card--body">
                                    <div class="card-image">
                                        <img src="{{ asset ('dist/img/'.$row1 -> image_product) }}" alt="" style="height: 270px; width:190px; margin-left: auto; margin-right: auto;">
                                        <div class="hover-contents">
                                            <a href="{{route('product.product-detail', ['id' => $row1->id])}}" class="hover-image">
                                                <img src="{{ asset ('dist/img/'.$row1 -> image_product) }}" alt="" style="height: 270px; width:190px; margin-left: auto; margin-right: auto;">
                                            </a>
                                            <div class="hover-btns">
                                                <form action="{{ route('cart.add', $row1->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="single-btn">
                                                        <i class="fas fa-shopping-basket"></i>
                                                    </button>
                                                </form>
                                                <a href="compare.html" class="single-btn">
                                                    <i class="fas fa-random"></i>
                                                </a>
                                                <button type="button" class="single-btn quick_view" data-bs-toggle="modal" data-bs-target="#quickModal" id="{{$row1->id}}">
                                                <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="price-block">
                                        <span class="price">{{ $row1->price - ($row->price * $row->sale / 100) }} VND</span>
                                        @if ($row1->sale > 0)
                                        <del class="price-old">{{$row1 -> price}} VND</del>
                                        @endif
                                        @if ($row1->sale > 0)
                                        <span class="price-discount">{{$row1 -> sale}} %</span>
                                        @endif
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=================================
        Deal of the day 
        ===================================== -->
<section class="section-margin">
    <div class="container-fluid">
        <div class="promo-section-heading">
            <h2>Những sản phẩm đang được sale </h2>
        </div>
        <div class="product-slider with-countdown  slider-border-single-row sb-slick-slider" data-slick-setting='{
                "autoplay": true,
                "autoplaySpeed": 8000,
                "slidesToShow": 6,
                "dots":true
            }' data-slick-responsive='[
                {"breakpoint":1400, "settings": {"slidesToShow": 4} },
                {"breakpoint":992, "settings": {"slidesToShow": 3} },
                {"breakpoint":768, "settings": {"slidesToShow": 2} },
                {"breakpoint":575, "settings": {"slidesToShow": 2} },
                {"breakpoint":490, "settings": {"slidesToShow": 1} }
            ]'>
            @foreach ( $data4 as $row )
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
                                                <button type="button" class="single-btn quick_view" data-bs-toggle="modal" data-bs-target="#quickModal" id="{{$row->id}}">
                                                <i class="fas fa-eye"></i>
                                                </button>
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
                                </div>
                            </div>
                        </div>
                        @endforeach
        </div>
    </div>
</section>
<!--=================================
        Best Seller Product
        ===================================== -->
<!--=================================
        CHILDREN’S BOOKS 
        ===================================== -->
<!--=================================
        Promotion Section Two
        ===================================== -->


<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade modal-quick-view" id="quickModal" tabindex="-1" role="dialog" aria-labelledby="quickModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="product-details-modal">
            <div class="modal-body" id = "quick_view_body">
            </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    //ajax request send for collect childcategory
    $(document).on('click', '.quick_view', function() {
        var id = $(this).attr("id");
        $.ajax({
            url: "{{ url("/product-quick-view/") }}/" + id,
            type: 'get',
            success: function(data) {
                $("#quick_view_body").html(data);
            }
        });
    });
</script>
@endsection