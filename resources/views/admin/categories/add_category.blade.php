@extends('admin.layout.master')
@section('content')
<style>
  .error-input {
    border: 1px solid red;
  }
</style>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Thêm danh mục</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Quản lý danh mục</li>
          <li class="breadcrumb-item active">Thêm danh mục</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">Thêm danh mục</h3>
  </div>
  <form action="{{ route('category.store') }}" method="post">
    @csrf
    <div class="form-group">
      <div class="card-body">
        <label for="exampleInputEmail1">Danh mục</label>
        <input type="text" class="form-control {{ $errors->has('name') ? 'error-input' : '' }}" id="exampleInputEmail1" placeholder="Danh mục" name="name" value="{{old('name')}}">
        <span class="text-danger">{{$errors->first('name')}}</span>
      </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Thêm mới</button>
    </div>
  </form>
  @endsection