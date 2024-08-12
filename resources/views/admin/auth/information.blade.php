@extends('admin.layout.master')
@section('content')
<style>
  .error {
    color: red;
  }
  .input-error {
            border: 2px solid red;
        }
</style>
<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">Thông tin cá nhân</h3>
  </div>
  <form action="{{ route('user.update', session('admin')->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
      <div class="form-group">
        <label for="exampleInputEmail1">Họ và tên</label>
        <input type="text" class="form-control" placeholder="Họ và tên" value="{{ session('admin')->username }}" name="username">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Địa chỉ email</label>
        <input type="email" class="form-control" placeholder="Nhập email" value="{{ session('admin')->email }}" name="email">
        @if ($errors->has('email'))
        <div class="error">{{ $errors->first('email') }}</div>
        @endif
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Phone Number</label>
        <input type="number" class="form-control" placeholder="Enter email" value="{{ session('admin')->phone_number }}" name="phone_number">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Mật khẩu hiện tại</label>
        <input id="current_password" class="form-control {{ $errors->has('current_password') ? 'input-error' : '' }}" placeholder="Current Password" type="password" name="current_password">
        @if ($errors->has('current_password'))
        <div class="error">{{ $errors->first('current_password') }}</div>
        @endif
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Mật khẩu mới</label>
        <input type="password" class="form-control {{ $errors->has('password') ? 'input-error' : '' }}" id="password" placeholder="New Password" name="password">
        @if ($errors->has('password'))
        <div class="error">{{ $errors->first('password') }}</div>
        @endif
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Xác nhận mật khẩu mới</label>
        <input id="password_confirmation" placeholder="Confirm Password" type="password" name="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'input-error' : '' }}">
        @if ($errors->has('password_confirmation'))
        <div class="error">{{ $errors->first('password_confirmation') }}</div>
        @endif
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Vai trò</label>
        <input type="text" class="form-control" placeholder="Enter email" value="{{ session('admin') && session('admin')->level == 0 ? 'admin' : (session('admin') && session('admin')->level == 1 ? 'member' : '') }}">
      </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
</div>
@endsection