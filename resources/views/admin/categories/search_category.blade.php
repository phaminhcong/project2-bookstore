@extends('admin.layout.master')
@section('content')
<style>
        .highlight {
            font-weight: bold;
            background-color: yellow;
        }
    </style>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Thông tin danh mục</h3>
        <div class="card-tools">
          <form action="{{ route('category.search') }}" method="GET">
            <div class="input-group input-group-sm" style="width: 200px;">
              <input type="text" name="search" class="form-control float-right" placeholder="Nhập tên sản phẩm" value="{{ $searchTerm ?? '' }}">
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
              <th>Option</th>

            </tr>
          </thead>
          <tbody>
            @foreach ($categories as $row )
            <tr>
              <td>{{$row -> id}}</td>
              <td>{!! str_replace($searchTerm, '<span class="highlight">' . $searchTerm . '</span>', $row->name) !!}</td>
              <td>
                <a href="{{route('softDeleted', ['id' => $row->id])}}" onclick=" return xoa(); "><i class="fas fa-trash" style="font-size:25px;color:red"></i></a>
                &nbsp;
                <a href="{{ route('category.edit', $row->id) }}"><i class="fas fa-wrench" style="font-size:25px;color:blue"></i></ </td>
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
          {{$categories -> render()}}
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