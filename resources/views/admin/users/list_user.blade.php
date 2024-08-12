@extends('admin.layout.master')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Thông tin khách hàng</h3>

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
              <th>Tên</th>
              <th>Email</th>
              <th>Số điện thoại</th>
              <th>Level</th>
              <th>Option</th>

            </tr>
          </thead>
          <tbody>
            @foreach ($admin as $admins)
            <tr>
              <td>{{$admins -> id}}</td>
              <td>{{$admins -> username}}</td>
              <td>{{$admins -> email}}</td>
              <td>{{$admins -> phone_number}}</td>

              <td>
                @if ($admins -> level == 0)
                <p>Admin</p>
                @else
                <p>Member</p>
                @endif

              <td>
                @if (session('admin')->level != 1 && session('admin')->id != $admins->id)
                <a href="{{ route('softDeletedUser', ['id' => $admins->id]) }}" onclick="return checkPermissionAndDelete();">
                  <i class="fas fa-trash" style="font-size:25px;color:red"></i>
                </a>
                @elseif (session('admin')->id == $admins->id)
                <a href="#" onclick="return showCannotDeleteSelfMessage();">
                  <i class="fas fa-trash" style="font-size:25px;color:red"></i>
                </a>
                @else
                <a href="#" onclick="return showInsufficientPermissionMessage();">
                  <i class="fas fa-trash" style="font-size:25px;color:red"></i>
                </a>
                @endif
                &nbsp;
    
                <a href="{{ route('user.edit', $admins->id) }}" onclick="return checkPermissionAndEdit();"><i class="fas fa-wrench" style="font-size:25px;color:blue"></i></a>
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
          {{$admin -> render()}}
        </li>
      </ul>
    </div>
  </div>
  <script>
    function xoa() {
      return confirm("Bạn có muốn xóa?");
    }
  </script>
  <script>
    function checkPermissionAndDelete() {
      return confirm("'Bạn có muốn xóa tài khoản này ? '");
    }

    function showInsufficientPermissionMessage() {
      alert('Bạn không đủ quyền để xóa tài khoản');
      return false; // Return false to prevent the link action
    }

    function showCannotDeleteSelfMessage() {
      alert('Tài khoản đang đăng nhập ');
      return false;
    }
    function checkPermissionAndEdit() {
        if ({{ session('admin')->level }} !== 0) {
            alert('Bạn không có quyền sửa');
            return false;
        }
        // Add any further logic here if needed
        return true; // Allow the default action (navigation to the edit route)
    }
  </script>
  @endsection