<div class="modal-body">
<div class="row">
                    <div class="col-lg-5">
                        <!-- Product Details Slider Big Image-->
                        <div class="product-details-slider sb-slick-slider arrow-type-two" data-slick-setting='{
                                    "slidesToShow": 1,
                                    "arrows": false,
                                    "fade": true,
                                    "draggable": false,
                                    "swipe": false,
                                    "asNavFor": ".product-slider-nav"
                                    }'>
                            <div class="single-slide">
                                <img  src="{{ asset ('dist/img/'.$product_quick -> image_product) }}" alt="" style="height: 500px; width:400px;">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 mt--30 mt-lg--30">
                        <div class="product-details-info pl-lg--30 ">
                            <p class="tag-block">Tác giả: <a href="#"> @foreach($product_quick->authors as $author)
                                {{ $author->name }}{{ !$loop->last ? ',' : '' }}
                                @endforeach</a></p>
                                <p class="tag-block"> Thể loại:
                                <span class="list-value"> @foreach($product_quick->categories as $category)
                                {{ $category->name }}{{ !$loop->last ? ',' : '' }}
                                @endforeach</span></li></p>
                            <h3 class="product-title">{{$product_quick->name}}</h3>
                            <ul class="list-unstyled">
                                <li>Giá gốc: <span class="list-value"> {{$product_quick->price}} VNĐ</span></li>
                                <li>Sale: <span class="list-value"> {{$product_quick->sale}} %</span></li>
                                <li>Đã bán: <span class="list-value"> {{$soldProducts}} sản phẩm</span></li>
                                <li>Sản phẩm còn lại: <span class="list-value"> {{$product_quick->quantity}} sản phẩm</span></li>
                                
                            </ul>
                            <div class="price-block">
                                <span class="price-new">{{ $product_quick->price - ($product_quick->price * $product_quick->sale / 100) }} VNĐ</span>
                                @if ($product_quick->sale > 0)
                                        <del class="price-old">{{$product_quick -> price}} VNĐ</del>
                                        @endif
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
                                <p>{{$product_quick->prd_desc}}</p>
                            </article>
                            <div class="add-to-cart-row">
                                <div class="add-cart-btn">
                                <form action="{{ route('cart.add', $product_quick->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outlined--primary"><span class="plus-icon">+</span>Add to
                                    Cart</button>
                            </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</div>