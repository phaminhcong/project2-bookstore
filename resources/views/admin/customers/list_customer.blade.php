@extends('admin.layout.master')
@section('content')
<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Thông tin khách hàng</h3>

                <div class="card-tools">
                <form action="{{ route('customer.search') }}" method="GET">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="search" class="form-control float-right" placeholder="Nhập email khách hàng">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </form>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Tên</th>
                      <th>Email</th>
                      <th>Số điện thoại</th>
                      <th>Option</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($customer as $row)
                      
                     
                    <tr>
                      <td>{{$row -> id}}</td>
                      <td>{{$row -> name}}</td>
                      <td>{{$row -> email}}</td>
                      <td>{{$row -> phone_number}}</td>
                      <td> 
                      <a href="{{route('softDeletedCustomer', ['id' => $row->id])}}" onclick=" return xoa(); "><i class="fas fa-trash" style="font-size:25px;color:red"></i></a>
                        &nbsp;
                      </td>
                    </tr> 
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

          <div class="card-footer clearfix">
      <ul class="pagination pagination-sm m-0 float-left">
        <li>
          {{$customer -> render()}}
        </li>
      </ul>
    </div>
        </div>
        <script>
    function xoa() {
      return confirm("Bạn có muốn xóa?");
    }
  </script>
@endsection