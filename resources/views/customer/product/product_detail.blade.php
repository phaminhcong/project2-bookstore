@extends('customer.customer')
@section('content')
<section class="breadcrumb-section">
    <h2 class="sr-only">Site Breadcrumb</h2>
    <div class="container">
        <div class="breadcrumb-contents">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Product Details</li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<main class="inner-page-sec-padding-bottom">
    <div class="container">
        <div class="row  mb--60">
            <div class="col-lg-5 mb--30">
                <!-- Product Details Slider Big Image-->
                <div class="product-details-slider sb-slick-slider arrow-type-two">
                    <div class="single-slide">
                        <img src="{{ asset ('dist/img/'.$product_detail -> image_product) }}" alt="">
                    </div>

                </div>
                <!-- Product Details Slider Nav -->
            </div>
            <div class="col-lg-7">
                <div class="product-details-info pl-lg--30 ">
                    <h3 class="product-title">{{$product_detail -> name}}</h3>
                    <ul class="list-unstyled">
                        <li>Tác giả : <span class="list-value"> @foreach($product_detail->authors as $author)
                                {{ $author->name }}{{ !$loop->last ? ',' : '' }}
                                @endforeach</span></li>
                    </ul>
                    <ul class="list-unstyled">
                        <li>Thể loại : <span class="list-value"> @foreach($product_detail->categories as $category)
                                {{ $category->name }}{{ !$loop->last ? ',' : '' }}
                                @endforeach</span></li>
                    </ul>
                    <div class="price-block">
                        <span class="price-new">{{ $product_detail->price - ($product_detail->price * $product_detail->sale / 100) }} VND</span>
                        <del class="price-old">{{$product_detail ->price}} VND</del>
                    </div>
                    <div class="rating-widget">
                        <div class="rating-block">
                            @for($i = 1; $i <= 5; $i++) @if($i <=floor($formattedAverageRating)) <span class="fas fa-star star_on"></span>
                                @elseif($i == ceil($formattedAverageRating))
                                @if($formattedAverageRating - floor($formattedAverageRating) >= 0.5)
                                <span class="fas fa-star-half-alt star_on"></span>
                                @else
                                <span class="fas fa-star"></span>
                                @endif
                                @else
                                <span class="fas fa-star"></span>
                                @endif
                                @endfor
                        </div>
                        <div class="review-widget">
                             
                            <a href="#">{{$formattedAverageRating}}</a><span>|</span>
                            <a href="#">({{$reviews->count()}} Reviews)</a>
                        </div>
                    </div>
                    <article class="product-details-article">
                        <h4 class="sr-only">Product Summery</h4>
                        <p>{{$product_detail ->prd_desc}}</p>
                    </article>
                    <div class="add-to-cart-row">
                        <div class="add-cart-btn">
                            <form action="{{ route('cart.add', $product_detail->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outlined--primary"><span class="plus-icon">+</span>Add to
                                    Cart</button>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="sb-custom-tab review-tab section-padding">
            <ul class="nav nav-tabs nav-style-2" id="myTab2" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tab1" data-bs-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true">
                        DESCRIPTION
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab2" data-bs-toggle="tab" href="#tab-2" role="tab" aria-controls="tab-2" aria-selected="true">
                        REVIEWS ({{$reviews->count()}})
                    </a>
                </li>
            </ul>
            <div class="tab-content space-db--20" id="myTabContent">
                <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="tab1">
                    <article class="review-article">
                        <h1 class="sr-only">Tab Article</h1>
                        <p>Fashion has been creating well-designed collections since 2010. The brand offers
                            feminine designs delivering
                            stylish
                            separates and statement dresses which have since evolved into a full ready-to-wear
                            collection in which every
                            item is
                            a
                            vital part of a woman's wardrobe. The result? Cool, easy, chic looks with youthful
                            elegance and unmistakable
                            signature
                            style. All the beautiful pieces are made in Italy and manufactured with the greatest
                            attention. Now Fashion
                            extends
                            to
                            a range of accessories including shoes, hats, belts and more!</p>
                    </article>
                </div>
                <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="tab2">
                    <div class="review-wrapper">
                        @if(Auth::guard('customer')->check())
                        @if(!$hasCommented)
                        <h2 class="title-lg mb--20 pt--15">ADD A REVIEW</h2>
                        <div class="rating-row pt-2">

                            <form action="{{ route('review.post') }}" method="POST">
                                @csrf
                                <p class="d-block">Đánh giá</p>
                                <span class="rating-widget-block">
                                    <input type="radio" name="evaluate" id="star5" value="5">
                                    <label for="star5"></label>
                                    <input type="radio" name="evaluate" id="star4" value="4">
                                    <label for="star4"></label>
                                    <input type="radio" name="evaluate" id="star3" value="3">
                                    <label for="star3"></label>
                                    <input type="radio" name="evaluate" id="star2" value="2">
                                    <label for="star2"></label>
                                    <input type="radio" name="evaluate" id="star1" value="1">
                                    <label for="star1"></label>
                                </span>
                                <input type="hidden" name="product_id" value="{{ $product_detail->id }}">
                                <input type="hidden" name="customer_id" value="{{ session('customer')->id }}">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="message" name="comments">Comment</label>
                                            <textarea id="message" cols="30" rows="10" class="form-control" name="comments"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="submit-btn" style="float: right;">
                                            <button type="submit" class="btn btn-black">Post Comment</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @else
                            <p>Bạn đã đánh giá sản phẩm</p>
                        @endif

                        @else
                        Chỉ có thành viên mới có thể nhận xét.Vui lòng <a href="/cilent/login"><b>đăng nhập</b></a> hoặc <a href="/cilent/register"><b>đăng ký</b></a>
                        @endif
                        <h2 class="title-lg mb--20"> Có {{$reviews->count()}} đánh giá về sản phẩm.</h2>
                        @foreach($reviews->take(4) as $review)
                        <div class="review-comment mb--20">
                            <div class="text">
                                <span style="font-size:20px;color:#FFCC00">
                                    @for($i = 0; $i < 5; $i++) @if($i < $review->evaluate)
                                        ★
                                        @else
                                        ☆
                                        @endif
                                        @endfor
                                </span>
                                <h6 class="author">{{$review->customer->name}} – <span class="font-weight-400">{{$review->review_at}}</span>
                                </h6>
                                <p>{{$review->comments}}</p>
                            </div>
                        </div>
                        @endforeach
                        @if($reviews->count() > 4)
                        <button class="view-more-reviews">Xem thêm...</button>
                        @endif
                        <div id="additional-reviews" style="display: none;">
                            @foreach($reviews->skip(4) as $review)
                            <div class="review-comment mb--20">
                                <div class="text">
                                    <span style="font-size:20px;color:#FFCC00">
                                        @for($i = 0; $i < 5; $i++) @if($i < $review->evaluate)
                                            ★
                                            @else
                                            ☆
                                            @endif
                                            @endfor
                                    </span>
                                    <h6 class="author">{{$review->customer->name}} – <span class="font-weight-400">{{$review->review_at}}</span>
                                    </h6>
                                    <p>Lorem et placerat vestibulum, metus nisi posuere nisl, in accumsan elit odio
                                        quis mi.</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var showMoreButton = document.querySelector('.view-more-reviews');
                var additionalReviews = document.getElementById('additional-reviews');

                // Xử lý sự kiện khi nhấp vào nút xem thêm
                showMoreButton.addEventListener('click', function() {
                    additionalReviews.style.display = 'block';
                    showMoreButton.style.display = 'none'; // Ẩn nút xem thêm sau khi nhấp vào
                    // Lướt xuống phần xem thêm
                    window.scrollTo({
                        top: additionalReviews.offsetTop,
                        behavior: 'smooth'
                    });
                });
            });
        </script>
        @endsection