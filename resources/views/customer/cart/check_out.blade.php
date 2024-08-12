@extends('customer.customer')
@section('content')
<style>
    .error-input {
        border: 1px solid red;
    }

    .center-message {
        display: none;
        position: fixed;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        padding: 20px;
        background-color: rgba(0, 0, 0, 0.8);
        color: white;
        border-radius: 8px;
        text-align: center;
        z-index: 1000;
    }
</style>
<section class="breadcrumb-section">
    <h2 class="sr-only">Site Breadcrumb</h2>
    <div class="container">
        <div class="breadcrumb-contents">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Checkout</li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<main id="content" class="page-section inner-page-sec-padding-bottom space-db--20">
    <div class="container">
        <form action="{{ route('cart.cartOrder') }}" method="post">
            <div class="row">
                <div class="col-12">
                    <!-- Checkout Form s-->
                    <div class="checkout-form">
                        <div class="row row-40">
                            <div class="col-12">
                                <h1 class="quick-title">Checkout</h1>
                                <!-- Slide Down Trigger  -->
                                
                            </div>
                            @if(Session::has('error'))
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    toastr.error("{{ Session::get('error') }}");
                                });
                            </script>
                            @endif

                            <div class="col-lg-7 mb--20">
                                <!-- Billing Address -->

                                @csrf
                                <div id="billing-form" class="mb-40">
                                    <h4 class="checkout-title">Billing Address</h4>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-12 mb--20">
                                                <label for="receiveName">Họ và tên</label>
                                                <input type="text" placeholder="Họ và tên:" name="receiveName" id="receiveName" value="{{ Auth::guard('customer')->check() ? Auth::guard('customer')->user()->name : '' }}" class="">
                                                <span class="text-danger">{{$errors->first('receiveName')}}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-12 col-12 mb--20">
                                                <label for="receiveAddress">Địa chỉ nhận hàng*</label>
                                                <input type="text" placeholder="Nhập địa chỉ:" name="receiveAddress" id="myInput" value="{{ old('receiveAddress')}}">
                                                <span class="text-danger">{{$errors->first('receiveAddress')}}</span>

                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12 mb--20">
                                            <div class="form-group">
                                                <label>Email Address*</label>
                                                <input type="email" placeholder="Email Address" name="receiveEmail" value="{{ Auth::guard('customer')->check() ? Auth::guard('customer')->user()->email : '' }}">
                                                <span class="text-danger">{{$errors->first('receiveEmail')}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12 mb--20">
                                            <div class="form-group">
                                                <label>Phone no*</label>
                                                <input type="text" placeholder="Phone number" name="receivePhoneNumber" value="{{ Auth::guard('customer')->check() ? Auth::guard('customer')->user()->phone_number : '' }}">
                                                <span class="text-danger">{{$errors->first('receivePhoneNumber')}}</span>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="order-note-block mt--30">
                                            <label for="order-note">Order notes</label>
                                            <textarea id="order-note" cols="30" rows="10" class="order-note" placeholder="Ghi chú về đơn đặt hàng của bạn, ví dụ: ghi chú đặc biệt để giao hàng." name="orderNote" value="{{ old('orderNote') }}"></textarea>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="col-lg-5">
                                <div class="row">
                                    <!-- Cart Total -->
                                    <div class="col-12">
                                        <div class="checkout-cart-total">
                                            <h2 class="checkout-title">YOUR ORDER</h2>
                                            <h4>Product <span>Total</span></h4>
                                            <ul>
                                                @foreach($cart as $id => $row)
                                                <li><span class="left"> {{($row['name'])}} x {{($row['quantity'])}} </span> <span class="right"> {{( $row['price']  - ($row['price']  * $row['sale'] / 100) ) * $row['quantity'] }} VND </span></li>
                                                @endforeach
                                            </ul>
                                            <h4>Grand Total <span>{{ app('App\Http\Controllers\Customer\Cart\CartController')->getTotal() }} VNĐ</span></h4>
                                            <div class="method-notice mt--25">
                                                <button class="place-order w-100" type="submit">Place order</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        // Cấu hình cho toastr nếu cần
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-center",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    </script>

</main>


@endsection