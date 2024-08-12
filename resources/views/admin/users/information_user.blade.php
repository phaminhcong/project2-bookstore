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
  <form action="{{ route('user.update-user', $admin->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
      <div class="form-group">
        <label for="exampleInputEmail1">Họ và tên</label>
        <input type="text" class="form-control " placeholder="Họ và tên" value="{{ $admin->username }}" name="username">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Địa chỉ email</label>
        <input type="email" class="form-control {{ $errors->has('email') ? 'input-error' : '' }}" placeholder="Nhập email" value="{{ $admin->email }}" name="email">
        @if ($errors->has('email'))
        <div class="error">{{ $errors->first('email') }}</div>
        @endif
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Phone Number</label>
        <input type="number" class="form-control {{ $errors->has('phone_number') ? 'input-error' : '' }}" placeholder="Enter email" value="{{ $admin->phone_number }}" name="phone_number">
        @if ($errors->has('phone_number'))
        <div class="error">{{ $errors->first('phone_number') }}</div>
        @endif
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
        <select type="text" class="form-control" placeholder="Enter email" value="{{ $admin && $admin->level == 0 ? 'admin' : ($admin && $admin->level == 1 ? 'member' : '') }}" name ="level" id="level">
        <option value="0" {{ $admin->level == 0 ? 'selected' : '' }}>Admin</option>
        <option value="1" {{ $admin->level == 1 ? 'selected' : '' }}>Member</option>
        </select>
      </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
</div>
@endsection