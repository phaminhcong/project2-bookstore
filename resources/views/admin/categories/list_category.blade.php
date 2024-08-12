@extends('admin.layout.master')
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Danh sách danh mục</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Quản lý danh mục</li>
          <li class="breadcrumb-item active">Danh sách danh mục</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Thông tin danh mục</h3>
        <div class="card-tools">
          <form action="{{ route('category.search') }}" method="GET">
            <div class="input-group input-group-sm" style="width: 200px;">
              <input type="text" name="search" class="form-control float-right" placeholder="Nhập tên sản phẩm">
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
            @foreach ($category as $row )
            <tr>
              <td>{{$row -> id}}</td>
              <td>{{$row -> name}}</td>
              <td>
                <a href="{{route('softDeleted', ['id' => $row->id])}}" onclick=" return xoa(); "><i class="fas fa-trash" style="font-size:25px;color:red"></i></a>
                &nbsp;
                <a href="{{ route('category.edit', $row->id) }}"><i class="fas fa-wrench" style="font-size:25px;color:blue"></i></td>
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
          {{$category -> render()}}
        </li>
      </ul>
    </div>
  </div>
  <script>
    function xoa() {
      return confirm("Bạn có muốn xóa?");
    }
  </script>
  @if(Session::has('success'))
  <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
    {{ Session::get('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <script>
    // JavaScript để ẩn thông báo sau 3 giây
    setTimeout(function() {
      document.getElementById('success-alert').style.display = 'none';
    }, 3000); // Thời gian tính bằng mili giây (ở đây là 3 giây)
  </script>
  @endif
  @if(Session::has('successUpdate'))
  <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
    {{ Session::get('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <script>
    // JavaScript để ẩn thông báo sau 3 giây
    setTimeout(function() {
      document.getElementById('success-alert').style.display = 'none';
    }, 3000); // Thời gian tính bằng mili giây (ở đây là 3 giây)
  </script>
  @endif

  @endsection