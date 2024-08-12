@extends('admin.layout.master')
@section('content')
<style>
    .error-input {
        border: 1px solid red;
    }
</style>
<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">Sửa danh mục</h3>
  </div>
  <form action="{{ route('category.update', $category->id) }}" method="POST">
    @csrf
    <div class="form-group">
      <div class="card-body">
        <label for="exampleInputEmail1">Danh mục</label>
        <input type="text" class="form-control {{ $errors->has('name') ? 'error-input' : '' }}"  id="exampleInputEmail1" placeholder="Danh mục" name="name" value="{{ $category->name}}">
        <div class="mb-3">
        <span class="text-danger">{{$errors->first('name')}}</span>
      </div>
      </div>
      
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary"> Sửa </button>
    </div>
  </form>
  @endsection