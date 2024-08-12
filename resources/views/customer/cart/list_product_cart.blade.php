
@extends('customer.customer')
@section('content')
<section class="breadcrumb-section">
    <h2 class="sr-only">Site Breadcrumb</h2>
    <div class="container">
        <div class="breadcrumb-contents">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Cart</li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<!-- Cart Page Start -->
<main class="cart-page-main-block inner-page-sec-padding-bottom">
 <form id="outerForm" action="{{ route('cart.update') }}" method="POST"> 
 @csrf
    <div class="cart_area cart-area-padding  ">
        <div class="container">
            <div class="page-section-title">
                <h1>Shopping Cart</h1>
            </div>
            
                <div class="row">
                    <div class="col-12">
                        <!-- Cart Table -->
                        @if(!empty($cart))
                        <div class="cart-table table-responsive mb--40">
                            <table class="table">
                                <!-- Head Row -->
                                <thead>
                                    <tr>
                                    <th class="pro-remove"> </th>
                                        <th class="pro-thumbnail">Image</th>
                                        <th class="pro-title">Product</th>
                                        <th class="pro-price">Sale</th>
                                        <th class="pro-price">Price</th>
                                        <th class="pro-quantity">Quantity</th>
                                        <th class="pro-subtotal">Total</th>
        
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Product Row -->
                                    @foreach($cart as $id => $row)
                                    <tr>
                                         <td class="pro-remove"> <a href="{{ route('cart.remove', $row['id']) }}" onclick=" return xoa(); "><i class="far fa-trash-alt"></i> </td>
                                        </form>
                                        <td class="pro-thumbnail"><img src="{{ asset ('dist/img/'.$row['image_product']) }}"></td>
                                        <td class="pro-title"><span>{{$row['name']}}</span></td>
                                        <td class="pro-price"><span>{{$row['sale']}} %</span></td>
                                        <td class="pro-price"><span>{{ $row['price']  - ($row['price']  * $row['sale'] / 100) }}</span></td>
                                        <td class="pro-quantity">
                                            <div class="pro-qty">
                                                <div class="count-input-block">
                                                    <input type="number" class="form-control text-center" value="{{ $row['quantity'] }}" name="quantity[{{ $id }}]" min= "1">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="pro-subtotal"><span> {{( $row['price']  - ($row['price']  * $row['sale'] / 100) ) * $row['quantity'] }} VND </span></td>
                                    </tr>
                                    @endforeach
                                    <!-- Product Row -->
                                </tbody>
                            </table>
                            @else
                            <p>Your cart is empty.</p>
                            @endif
                        </div>

                    </div>
                </div>
        </div>
    </div>
    <div class="cart-section-2">
        <div class="container">
            <div class="row">
						<div class="col-lg-6 col-12 mb--30 mb-lg--0">
                          <div class="cart-summary">
                            <div class="cart-summary-button">
                             <a href="/cilent" class="checkout-btn c-btn btn--primary" style="width:auto; float: left"> ⇦ Tiếp tục mua sắm </a>
                            </div>
                         </div>
                        </div>

                <!-- Cart Summary -->
                <div class="col-lg-6 col-12 d-flex">
                    <div class="cart-summary">
                        <div class="cart-summary-wrap">
                            <h4><span>Cart Summary</span></h4>
                            <p>Tổng tiền : <span class="text-primary">{{ app('App\Http\Controllers\Customer\Cart\CartController')->getTotal() }} VNĐ</span></p>
                            <p>Shipping Cost <span class="text-primary">0 VNĐ</span></p>
                            <h2>Grand Total <span class="text-primary">{{ app('App\Http\Controllers\Customer\Cart\CartController')->getTotal() }} VNĐ</span></h2>
                        </div>
                        <div class="cart-summary-button">
                            <a href="/cilent/cart-checkout" class="checkout-btn c-btn btn--primary">Checkout</a>
                            <button class="update-btn c-btn btn-outlined" >Update Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </form>
</main>
<script>
    document.getElementById('innerSubmitBtn').addEventListener('click', function() {
        var innerForm = document.getElementById('innerForm');
        var formData = new FormData(innerForm);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', innerForm.action, true);
        xhr.setRequestHeader('X-CSRF-Token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        xhr.onload = function() {
            // Xử lý phản hồi từ server
        };
        xhr.onerror = function() {
            // Xử lý lỗi
        };
        xhr.send(formData);
    });
</script>
<script>
  function xoa() {
    return confirm("Bạn có muốn xóa?");
  }
</script>
@if(Session::has('success'))
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    toastr.success("{{ Session::get('success') }}");
                                });
                            </script>
                            @endif
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

@endsection