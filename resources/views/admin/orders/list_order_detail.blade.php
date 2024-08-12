@extends('admin.layout.master')
@section('content')
@if (session('error'))
    <div id="error-message" class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
@if (session('success'))
    <div id="success-message" class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="row">

  <div class="col-12">
    <form action="{{ route('order.updateStatus', ['id' => $order->id]) }}" method="POST">
      @csrf
      <div class="form-group">
        <label>Cập nhật trạng thái đơn hàng</label>
        <div class="row">
          <div class="col-11">
            <select name="order_status" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
            <option value="0"   {{ $order->order_status == 0 ? 'selected' : '' }}>Đơn hàng đang chờ được xác nhận</option>
              <option value="1" {{ $order->order_status == 1 ? 'selected' : '' }}>Đơn hàng đã được duyệt</option>
              <option value="2" {{ $order->order_status == 2 ? 'selected' : '' }}>Đang chuẩn bị đơn hàng</option>
              <option value="3" {{ $order->order_status == 3 ? 'selected' : '' }}>Đơn hàng đã được chuyển</option>
              <option value="4" {{ $order->order_status == 4 ? 'selected' : '' }}>Giao thành công</option>
              <option value="5" {{ $order->order_status == 5 ? 'selected' : '' }}>Hủy</option>
            </select>
          </div>
          <div class="col-1">
            <button type="submit" class="btn btn-block btn-outline-primary">Cập nhật</button>
          </div>
        </div>
      </div>
    </form>
    <div class="card-header">
      <h3 class="card-title">Tổng giá trị đơn hàng: {{$order -> total_product_value}} VND</h3>
    </div>
    <div class="card-header">
      <h3 class="card-title">Tình trạng đơn hàng: @if($order -> order_status == 0)
                                Đơn hàng đang chờ được xác nhận
                                @endif
                                @if($order -> order_status == 1)
                                Đơn hàng đã được duyệt
                                @endif
                                @if($order -> order_status == 2)
                                Đang chuẩn bị đơn hàng
                                @endif
                                @if($order -> order_status == 3)
                                Đơn hàng đã được chuyển
                                @endif
                                @if($order -> order_status == 4)
                                Giao thành công
                                @endif
                                @if($order -> order_status == 5)
                                Hủy
                                @endif </h3>
    </div>
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Đơn hàng chi tiết</h3>
        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 200px;">
            <input type="text" name="table_search" class="form-control float-right" placeholder="Nhập email khách hàng">

            <div class="input-group-append">
              <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
          <thead>
            <tr>
              <th>Tên sản phẩm</th>
              <th>Hình ảnh sản phẩm</th>
              <th>Giá sản phẩm</th>
              <th>Sale</th>
              <th>Giá đã sale</th>
              <th>Số lượng đặt </th>
              <th>Tổng</th>

            </tr>
          </thead>
          <tbody>
            @foreach ($order_detail as $row )
            <tr>
              <td>{{$row -> product -> name}}</td>
              <td><img src="{{ asset ('dist/img/'.$row -> product -> image_product) }}" alt="User Avatar" style="height: 130px; width: 120px;"></td>

              <td>{{$row -> product -> price}} VND</td>
              <td>{{$row -> product -> sale}} %</td>
              <td>{{ $row -> product ->price - ($row-> product ->price * $row-> product ->sale / 100) }}</td>
              <td>{{$row -> quantity_product}}</td>
              <td>{{$row -> price_each_product}} VND</td>

            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var errorMessage = document.getElementById('error-message');
        if (errorMessage) {
            setTimeout(function() {
                errorMessage.style.display = 'none';
            }, 2000);
        }
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var successMessage = document.getElementById('success-message');
        if (successMessage) {
            setTimeout(function() {
              successMessage.style.display = 'none';
            }, 2000);
        }
    });
</script>
@endsection