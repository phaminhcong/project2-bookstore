@extends('admin.layout.master')
@section('content')
<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">Thêm khách hàng</h3>
  </div>
  <form>
    <div class="card-body">
      <div class="form-group">
        <label for="exampleInputEmail1">Họ và tên</label>
        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Email</label>
        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Mật khẩu</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Địa chỉ</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Số điện thoại</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
      </div>
      
      <div class="form-group">
        <label>Cấp</label>
        <select class="form-control select2" style="width: 100%;">
          <option>VIP</option>
          <option>Member</option>
        </select>
      </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
  @endsection