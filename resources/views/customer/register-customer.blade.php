@extends('customer.customer')
@section('content')
@extends('customer.customer')
@section('content')
<main class="page-section inner-page-sec-padding-bottom">
    <div class="container">
        <div class="sb-custom-tab">
            <div class="col-sm-12 col-md-12 col-xs-12 col-lg-12 mb--30 mb-lg--0">
                <div> ĐĂNG KÝ </div>
                <!-- Login Form s-->
                <form action="{{route('registerCustomer.store')}}" method="post">
                    @csrf
                    <div class="login-form">

                        <div class="row">
                            <div class="col-md-12 col-12 mb--15">
                                <label for="email">Họ và tên</label>
                                <input class="mb-0 form-control" type="text" id="name" name="name" placeholder="Enter your full name">
                            </div>
                            <div class="mb-3">
                                <span class="text-danger">{{$errors->first('name')}}</span>
                            </div>
                            <div class="col-12 mb--20">
                                <label for="email">Email</label>
                                <input class="mb-0 form-control" type="email" id="email" name="email" placeholder="Enter Your Email Address Here..">
                            </div>
                            <div class="mb-3">
                                <span class="text-danger">{{$errors->first('email')}}</span>
                            </div>
                            <div class="col-md-12 col-12 mb--15">
                                <label for="email">Số điện thoại</label>
                                <input class="mb-0 form-control" type="phone number" id="phone-number" name="phone_number" placeholder="Enter your phone number">
                            </div>
                            <div class="mb-3">
                                <span class="text-danger">{{$errors->first('phone_number')}}</span>
                            </div>
                            <div class="col-lg-6 mb--20">
                                <label for="password">Password</label>
                                <input class="mb-0 form-control" type="password" id="password" name="password" placeholder="Enter your password">
                            </div>
                            <div class="mb-3">
                                <span class="text-danger">{{$errors->first('password')}}</span>
                            </div>
                            <div class="col-lg-6 mb--20">
                                <label for="password">Repeat Password</label>
                                <input class="mb-0 form-control" type="password" id="repeat-password" name="password" placeholder="Repeat your password">
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-outlined">Đăng ký</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
</div>
@endsection
@endsection