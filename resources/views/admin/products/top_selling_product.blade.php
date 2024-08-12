@extends('admin.layout.master')
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Top 5 sản phẩm được đánh giá cao nhất</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<div class="row">
  <div class="col-12">
    <div class="card card-secondary ">
      <div class="card-header card-secondary">
        <h3 class="card-title">Thông tin sản phẩm</h3>
        <div class="card-tools">
          <form action="{{ route('product.search') }}" method="GET">
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
              <th>Tên sản phẩm</th>
              <th>Hình ảnh</th>
              <th>Tác giả</th>
              <th>Thể loại</th>
              <th>Số lượng</th>
              <th>Giá bán gốc</th>
              <th>Sale </th>
              <th>Giá sale</th>
              <th>Đã bán</th>
              <th>Option</th>
            </tr>
          </thead>
          <tbody>
            @foreach ( $topRatedProducts as $row )
            <tr>
              <td>{{$row ->product -> id}}</td>
              <td>{{$row ->product -> name}}</td>
              <td><img src="{{ asset ('dist/img/'.$row ->product -> image_product) }}" alt="User Avatar" style="height: 130px; width: 120px;"></td>
              <td>
                @foreach($row ->product ->authors as $author)
                {{ $author->name }}{{ !$loop->last ? ',' : '' }}
                @endforeach
              </td>
              <td>
                @foreach($row ->product->categories as $category)
                {{ $category->name }}{{ !$loop->last ? ',' : '' }}
                @endforeach
              </td>
              <td>{{$row ->product-> quantity}}</td>
              <td>{{$row ->product -> price}} VND</td>
              <td>{{$row ->product -> price}}</td>
              <td>{{$row ->product -> sale}} % </td>
              <td>{{ $row ->product->price - ($row->price * $row->sale / 100) }}</td>
              <td>{{$row ->total_quantity}}</td>
              <td>
                <a href="{{route('softDeleteProduct', ['id' => $row ->product->id])}} " onclick=" return xoa(); "> <i class="fas fa-trash" style="font-size:25px;color:red"></i></a>
                &nbsp;
                <a href="{{ route('product.edit', $row ->product->id) }}"> <i class="fas fa-wrench" style="font-size:25px;color:blue"></i></a>
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
</div>
<script>
  function xoa() {
    return confirm("Bạn có muốn xóa?");
  }
</script>

@endsection