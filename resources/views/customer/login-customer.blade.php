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
                       
<main class="page-section inner-page-sec-padding-bottom">
    <div class="container">
        <div class="sb-custom-tab">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
            
                <form action="{{ route('customer.login') }}" method="post">
                    @csrf
                    <div class="login-form">
                        <div class="row">
                            <div class="col-md-12 col-12 mb--15">
                                <label for="email">Nhập email của bạn</label>
                                <input class="mb-0 form-control" type="email" id="email1" name="email" placeholder="Enter you email address here...">
                                <span class="text-danger">{{$errors->first('email')}}</span>
                            </div>
                            <div class="col-12 mb--20">
                                <label for="password">Password</label>
                                <input class="mb-0 form-control" type="password" id="login-password" name="password" placeholder="Enter your password">
                                <span class="text-danger">{{$errors->first('password')}}</span>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-outlined">Đăng nhập</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</main>
</div>
@if(Session::has('error'))
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    toastr.error("{{ Session::get('error') }}");
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