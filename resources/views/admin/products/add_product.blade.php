@extends('admin.layout.master')
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Thêm sản phẩm</h3>
    </div>
    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên sản phẩm</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên sản phẩm" name="name">
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input required type="number" min="0" class="form-control" placeholder="Giá sản phẩm" name="price">
                    </div>
                    <div class="form-group">
                        <label>Quantity</label>
                        <input required type="number" class="form-control" placeholder="Số sản phẩm" name="quantity">
                    </div>
                    <div class="form-group">
                        <label> Description </label>
                        <input required type="text" class="form-control" placeholder="Mô tả sản phẩm" name="prd_desc">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Tác giả</label>
                        <div class="select2-blue">
                        <select class="select2" class="select2" multiple="multiple" data-placeholder="Chọn danh mục" data-dropdown-css-class="select2-blue" style="width: 100%;" name="author_id[]">
                            <option value="">Chọn tác giả</option>
                            @foreach ($author as $author)
                            <option value="{{ $author->id }}">{{ $author->name }}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="categories">Chọn danh mục</label>
                        <div class="select2-blue">
                            <select class="select2" multiple="multiple" data-placeholder="Chọn danh mục" data-dropdown-css-class="select2-blue" style="width: 100%;" name="cat_id[]">
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label> Ngày phát hành </label>
                        <input  required type="date" class="form-control" name = "publishing_year">
                    </div> -->
                    <div class="form-group">
                        <div>
                            <label for="image_product">Ảnh sản phẩm:</label>
                            <input type="file" name="image_product" id="image_product" required>
                            <div>
                                <img src="{{ asset('dist/img/no-image.png') }}" id="prd_image" width="200" height="200">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
    <script>
        document.getElementById('image_product').addEventListener('change', function(event) {
            var input = event.target;
            var reader = new FileReader();
            reader.onload = function() {
                var imgElement = document.getElementById('prd_image');
                imgElement.src = reader.result;
            }
            reader.readAsDataURL(input.files[0]);
        });
    </script>
    @endsection