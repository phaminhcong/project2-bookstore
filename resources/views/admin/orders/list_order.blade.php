@extends('admin.layout.master')
@section('content')
<style>
    .container {
        width: 150px;
        /* Giới hạn chiều rộng của phần tử cha */
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        /* Hiển thị dấu "..." khi văn bản vượt quá */
    }

    .container.full {
        white-space: normal;
        overflow: visible;
    }
</style>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Thông tin đơn hàng</h3>

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
                            <th>ID</th>
                            <th>Tên khách hàng</th>
                            <th>Email khách hàng</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Trạng thái</th>
                            <th>Phương thức</th>
                            <th>Ghi chú</th>
                            <th>Thời gian đặt hàng</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order as $row )
                        <tr>
                            <td>{{$row -> id}}</td>
                            <td>{{$row -> receiveName}}</td>
                            <td>{{$row -> receiveEmail}}</td>
                            <td>{{$row -> receivePhoneNumber}}</td>
                            <td>
                                <div class="container" id="container">
                                    <p class="text" id="text">{{$row -> receiveAddress}}</p>
                                </div>
                            </td>
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
                                @endif
                            </td>

                            <td>Chuyển khoản</td>
                            <td>
                                <div class="container" id="container">
                                    <p class="text" id="text">{{$row -> orderNote}}</p>
                                </div>
                            </td>
                            <td>{{$row -> order_date}}</td>
                            <td>
                                <a href="{{route('order.softDeleted', ['id' => $row->id])}}" onclick=" return xoa(); "><i class="fas fa-trash" style="font-size:25px;color:red"></i></a>
                                &nbsp;
                                <a href="{{route('orderDetail.show', ['order_id' => $row->id])}}">
                                    <i class="fas fa-info-circle" style="font-size:25px;color:black"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-left">
                <li>
                    {{$order -> render()}}
                </li>
            </ul>
        </div>
    </div>
</div>
<script>
    const containers = document.querySelectorAll('.container');
    const texts = document.querySelectorAll('.text');

    // Lặp qua từng phần tử container
    containers.forEach((container, index) => {
        container.addEventListener('mouseover', () => {
            // Thêm class full khi di chuột vào
            container.classList.add('full');
        });

        container.addEventListener('mouseout', () => {
            // Loại bỏ class full khi di chuột ra
            container.classList.remove('full');
        });
    });
</script>
@endsection