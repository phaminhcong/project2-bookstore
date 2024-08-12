@extends('customer.customer')
@section('content')
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
<section class="breadcrumb-section">
	<h2 class="sr-only">Site Breadcrumb</h2>
	<div class="container">
		<div class="breadcrumb-contents">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.html">Home</a></li>
					<li class="breadcrumb-item active">My Account</li>
				</ol>
			</nav>
		</div>
	</div>
</section>
<div class="page-section inner-page-sec-padding">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="row">
					<!-- My Account Tab Menu Start -->
					<div class="col-lg-3 col-12">
						<div class="myaccount-tab-menu nav" role="tablist">
							<a href="#dashboad" class="active" data-bs-toggle="tab"><i class="fas fa-tachometer-alt"></i>
								Dashboard</a>
							<a href="#orders" data-bs-toggle="tab"><i class="fa fa-cart-arrow-down"></i> Orders</a>
							<a href="#account-info" data-bs-toggle="tab"><i class="fa fa-user"></i> Account
								Details</a>
							<a href="/cilent/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
						</div>
					</div>
					<!-- My Account Tab Menu End -->
					<!-- My Account Tab Content Start -->
					<div class="col-lg-9 col-12 mt--30 mt-lg--0">
						<div class="tab-content" id="myaccountContent">
							<!-- Single Tab Content Start -->
							<div class="tab-pane fade show active" id="dashboad" role="tabpanel">
								<div class="myaccount-content">
									<h3>Dashboard</h3>
									<div class="welcome mb-20">
										<p>Xin chào, <strong>{{ session('customer')->name }}</strong>
									</div>
									<p class="mb-0">Từ bảng điều khiển tài khoản của bạn. bạn có thể dễ
										dàng kiểm tra và xem các đơn đặt hàng gần đây của mình, quản lý
										địa chỉ giao hàng và thanh toán cũng như chỉnh sửa chi tiết mật
										khẩu và tài khoản của mình.</p>
								</div>
							</div>
							<!-- Single Tab Content End -->
							<!-- Single Tab Content Start -->
							<div class="tab-pane fade" id="orders" role="tabpanel">
								<div class="myaccount-content">
									<h3>Orders</h3>
									<div class="myaccount-table table-responsive text-center">
										<table class="table table-bordered">
											<thead class="thead-light">
												<tr>
													<th>No</th>
													<th>Name</th>
													<th>Date</th>
													<th>Status</th>
													<th>Total</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												@foreach ($orders as $row )
												<tr>
													<td>{{$row->id}}</td>
													<td>{{$row->receiveName}}</td>
													<td>{{$row->order_date}}</td>
													<td>@if($row -> order_status == 0)
														Đơn hàng đang chờ được xác nhận
														@endif
														@if($row -> order_status == 1)
														Đơn hàng đã được duyệt
														@endif
														@if($row -> order_status == 2)
														Đang chuẩn bị đơn hàng
														@endif
														@if($row -> order_status == 3)
														Đơn hàng đã được chuyển
														@endif
														@if($row -> order_status == 4)
														Giao thành công
														@endif
														@if($row -> order_status == 5)
														Hủy
														@endif</td>
													<td>{{$row -> total_product_value}} VND </td>
													<form action="{{ route('order.cancel', ['id' => $row->id]) }}" method="POST">
														<td><a href="{{route('cart.order-history', ['id' => $row->id])}}" class="btn">Chi tiết </a>
															@if($row -> order_status == 0)
															@csrf
															<button type="submit" class="btn" onclick=" return xoa(); ">Hủy</button>
															@endif
														</td>
													</form>
												</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- Single Tab Content End -->
							<!-- Single Tab Content End -->
							<!-- Single Tab Content Start -->
							<form action="{{ route('customer.update', session('customer')->id) }}" method="post" enctype="multipart/form-data">
								@csrf
								<div class="tab-pane fade" id="account-info" role="tabpanel">
									<div class="myaccount-content">
										<h3>Tài khoản chi tiết</h3>
										<div class="account-details-form">
											<form action="#">
												<div class="row">
													<div class="col-12  mb--30">
														<input id="display-name" placeholder="Họ và tên" type="text" value="{{ session('customer')->name }}" name="name">
													</div>
													<div class="col-lg-6 col-12  mb--30">
														<input id="email" placeholder="Địa chỉ email" type="text" value="{{ session('customer')->email }}" name=email>
													</div>
													<div class="col-lg-6 col-12  mb--30">
														<input id="last-name" placeholder="Số điện thoại" type="text" value="{{ session('customer')->phone_number }}" name="phone_number">
													</div>
													<div class="col-12  mb--30">
														<h4>Password change</h4>
													</div>
													<div class="col-12  mb--30">
														<input id="current_password" placeholder="Current Password" type="password" name="current_password">
													</div>
													<div class="col-lg-6 col-12  mb--30">
														<input id="password" placeholder="New Password" type="password" name="password">
													</div>
													<div class="col-lg-6 col-12  mb--30">
														<input id="password_confirmation" placeholder="Confirm Password" type="password" name="password_confirmation">
													</div>
													<div class="col-12">
														<button type="submit" class="btn btn-primary">Lưu thay đổi</button>
													</div>

											</form>
										</div>
									</div>
								</div>
							</form>
							<!-- Single Tab Content End -->
						</div>
					</div>
					<!-- My Account Tab Content End -->
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	function xoa() {
		return confirm("Khi hủy thì đơn hàng sẽ bị xóa, bạn có chắc chắn muốn hủy?");
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