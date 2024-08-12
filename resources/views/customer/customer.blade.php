<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


<!-- Mirrored from htmldemo.net/pustok/pustok/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 21 Mar 2024 12:47:51 GMT -->

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>BOOKSHOP-PHAM MINH CONG</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Use Minified Plugins Version For Fast Page Load -->
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset ('htmldemo.net/css/plugins.css')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset ('htmldemo.net/css/main.css')}}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset ('dist/img/logoshop2.png')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        #hidden-content {
            display: none;
            /* Ẩn phần tử */
        }

        #my-button:hover #hidden-content {
            display: block;
            /* Hiện phần tử */
        }
    </style>
</head>

<body>
    <div class="site-wrapper" id="top">
        <div class="site-header d-none d-lg-block">
            <div class="header-middle pt--10 pb--10">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-3 ">
                            <a href="/cilent" class="site-brand">
                                <img src="{{ asset ('dist/img/logoshop2.png')}}" alt="">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <div class="header-phone ">
                                <div class="icon">
                                    <i class="fas fa-headphones-alt"></i>
                                </div>
                                <div class="text">
                                    <p>Free Support 24/7</p>
                                    <p class="font-weight-bold number">+01-202-555-0181</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="main-navigation flex-lg-right">
                                <ul class="main-menu menu-right ">
                                    <li class="menu-item">
                                        @if(session()->has('customer'))
                                        <a href="/cilent/information-customer/{{session('customer')->id}}">Xin chào, {{ session('customer')->name }}!</a>
                                        @else
                                        {{-- Không hiển thị gì cả --}}
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom pb--10">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-3">
                            <nav class="category-nav">
                                <div>
                                    <a href="javascript:void(0)" class="category-trigger"><i class="fa fa-bars"></i>Browse
                                        categories</a>
                                    <ul class="category-menu">
                                        @foreach ($categories as $category)
                                        <li class="cat-item ">
                                            <a href="/cilent/product-category/{{$category->id}}">{{ $category->name }}</a>
                                        </li>
                                        @endforeach
                                    </ul>


                                </div>

                            </nav>
                        </div>
                        <div class="col-lg-5">
                            <div class="header-search-block">
                                <input type="text" placeholder="Search entire store here">
                                <button>Search</button>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="main-navigation flex-lg-right">
                                <div class="cart-widget">
                                    @if(session()->has('customer'))
                                    @else
                                    <div class="login-block">
                                        <a href="{{ route('customer.login') }}" class="font-weight-bold">Login</a> <br>
                                        <span>or</span><a href="/cilent/register" class="font-weight-bold">Register</a>
                                    </div>
                                    @endif
                                    <div class="cart-block">
                                        <div class="cart-total">
                                            <span class="text-number">
                                                1
                                            </span>
                                            <span class="text-item">
                                                Shopping Cart
                                            </span>
                                            <span class="price">
                                                £0.00
                                                <i class="fas fa-chevron-down"></i>
                                            </span>
                                        </div>
                                        <div class="cart-dropdown-block">
                                            <div class=" single-cart-block ">
                                                
                                                <div class="cart-product">
                                                    <a href="product-details.html" class="image">
                                                        <img src="{{ asset ('htmldemo.net/image/products/cart-product-1.jpg')}}" alt="">
                                                    </a>
                                                    <div class="content">
                                                        <h3 class="title"><a href="product-details.html">Kodak PIXPRO
                                                                Astro Zoom AZ421 16 MP</a>
                                                        </h3>
                                                        <p class="price"><span class="qty">1 ×</span> £87.34</p>
                                                        <button class="cross-btn"><i class="fas fa-times"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" single-cart-block ">
                                                <div class="btn-block">
                                                    <a href="/cilent/cart" class="btn">View Cart <i class="fas fa-chevron-right"></i></a>
                                                    <a href="/cilent/cart-checkout" class="btn btn--primary">Check Out <i class="fas fa-chevron-right"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--=================================
        Hero Area
        ===================================== -->
        <!-- content -->
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div><!-- /.container-fluid -->
        </section>
        <!-- end-content -->
        <!--=================================
    Brands Slider
    ===================================== -->
        <section class="section-margin">
            <h2 class="sr-only">Brand Slider</h2>
            <div class="container">
                <div class="brand-slider sb-slick-slider border-top border-bottom" data-slick-setting='{
                                            "autoplay": true,
                                            "autoplaySpeed": 8000,
                                            "slidesToShow": 6
                                            }' data-slick-responsive='[
                {"breakpoint":992, "settings": {"slidesToShow": 4} },
                {"breakpoint":768, "settings": {"slidesToShow": 3} },
                {"breakpoint":575, "settings": {"slidesToShow": 3} },
                {"breakpoint":480, "settings": {"slidesToShow": 2} },
                {"breakpoint":320, "settings": {"slidesToShow": 1} }
            ]'>
                    <div class="single-slide">
                        <img src="image/others/brand-1.jpg" alt="">
                    </div>
                    <div class="single-slide">
                        <img src="image/others/brand-2.jpg" alt="">
                    </div>
                    <div class="single-slide">
                        <img src="image/others/brand-3.jpg" alt="">
                    </div>
                    <div class="single-slide">
                        <img src="image/others/brand-4.jpg" alt="">
                    </div>
                    <div class="single-slide">
                        <img src="image/others/brand-5.jpg" alt="">
                    </div>
                    <div class="single-slide">
                        <img src="image/others/brand-6.jpg" alt="">
                    </div>
                    <div class="single-slide">
                        <img src="image/others/brand-1.jpg" alt="">
                    </div>
                    <div class="single-slide">
                        <img src="image/others/brand-2.jpg" alt="">
                    </div>
                </div>
            </div>
        </section>
        <!--=================================
    Footer Area
    ===================================== -->
        <footer class="site-footer">
            <div class="container">
                <div class="row justify-content-between  section-padding">
                    <div class=" col-xl-3 col-lg-4 col-sm-6">
                        <div class="single-footer pb--40">
                            <div class="brand-footer footer-title">
                                <img src="{{ asset ('htmldemo.net/image/logo--footer.png')}}" alt="">
                            </div>
                            <div class="footer-contact">
                                <p><span class="label">Address:</span><span class="text">Example Street 98, HH2 BacHa, New
                                        York,
                                        USA</span></p>
                                <p><span class="label">Phone:</span><span class="text">+18088 234 5678</span></p>
                                <p><span class="label">Email:</span><span class="text">suport@hastech.com</span></p>
                            </div>
                        </div>
                    </div>
                    <div class=" col-xl-3 col-lg-2 col-sm-6">
                        <div class="single-footer pb--40">
                            <div class="footer-title">
                                <h3>Information</h3>
                            </div>
                            <ul class="footer-list normal-list">
                                <li><a href="#">Prices drop</a></li>
                                <li><a href="#">New products</a></li>
                                <li><a href="#">Best sales</a></li>
                                <li><a href="#">Contact us</a></li>
                                <li><a href="#">Sitemap</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class=" col-xl-3 col-lg-2 col-sm-6">
                        <div class="single-footer pb--40">
                            <div class="footer-title">
                                <h3>Extras</h3>
                            </div>
                            <ul class="footer-list normal-list">
                                <li><a href="#">Delivery</a></li>
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Stores</a></li>
                                <li><a href="#">Contact us</a></li>
                                <li><a href="#">Sitemap</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class=" col-xl-3 col-lg-4 col-sm-6">
                        <div class="footer-title">
                            <h3>Newsletter Subscribe</h3>
                        </div>
                        <div class="newsletter-form mb--30">
                            <form action="https://htmldemo.net/pustok/pustok/php/mail.php">
                                <input type="email" class="form-control" placeholder="Enter Your Email Address Here...">
                                <button class="btn btn--primary w-100">Subscribe</button>
                            </form>
                        </div>
                        <div class="social-block">
                            <h3 class="title">STAY CONNECTED</h3>
                            <ul class="social-list list-inline">
                                <li class="single-social facebook"><a href="#"><i class="ion ion-social-facebook"></i></a>
                                </li>
                                <li class="single-social twitter"><a href="#"><i class="ion ion-social-twitter"></i></a></li>
                                <li class="single-social google"><a href="#"><i class="ion ion-social-googleplus-outline"></i></a></li>
                                <li class="single-social youtube"><a href="#"><i class="ion ion-social-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <p class="copyright-heading">Suspendisse in auctor augue. Cras fermentum est ac fermentum tempor. Etiam
                        vel
                        magna volutpat, posuere eros</p>
                    <a href="#" class="payment-block">
                        <img src="image/icon/payment.png" alt="">
                    </a>
                    <p class="copyright-text">Copyright © 2022 <a href="#" class="author">Pustok</a>. All Right Reserved.
                        <br>
                        Design By Pustok
                    </p>
                </div>
            </div>
        </footer>
        <!-- Use Minified Plugins Version For Fast Page Load -->
        <script src="{{ asset('htmldemo.net/js/plugins.js')}}"></script>
        <script src="{{ asset('htmldemo.net/js/ajax-mail.js')}}"></script>
        <script src="{{ asset('htmldemo.net/js/custom.js')}}"></script>
        <script src="{{ mix('js/app.js') }}"></script>
        
</body>

</html>