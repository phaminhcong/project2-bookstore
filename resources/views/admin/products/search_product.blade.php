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
        <div class="card card-secondary ">
            <div class="card-header card-secondary">
                <h3 class="card-title">Thông tin sản phẩm</h3>

                <div class="card-tools">
                    <form action="{{ route('product.search') }}" method="GET">
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

            @if(!empty($products))
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
                            <th>Option</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $products as $row )
                        <tr>
                            <td>{{$row -> id}}</td>
                            <td>{!! str_replace($searchTerm, '<span class="highlight">' . $searchTerm . '</span>', $row->name) !!}</td>
                            <td><img src="{{ asset ('dist/img/'.$row -> image_product) }}" alt="User Avatar" style="height: 130px; width: 120px;"></td>
                            <td>{{$row -> author -> name}}</td>
                            <td>{{$row -> category -> name}}</td>
                            <td>{{$row-> quantity}}</td>
                            <td>{{$row -> price}} VND</td>
                            <td>{{$row -> sale}} % </td>
                            <td>{{ $row->price - ($row->price * $row->sale / 100) }}</td>
                            <td>
                                <a href="{{route('softDeleteProduct', ['id' => $row->id])}} " onclick=" return xoa(); "> <i class="fas fa-trash" style="font-size:25px;color:red"></i></a>
                                &nbsp;
                                <a href="{{ route('product.edit', $row->id) }}"> <i class="fas fa-wrench" style="font-size:25px;color:blue"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            @endif
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-left">
                <li>
                    {{$products -> render()}}
                </li>
            </ul>
        </div>

    </div>
</div>
<script>
    function xoa() {
        return confirm("Bạn có muốn xóa?");
    }
</script>
@endsection