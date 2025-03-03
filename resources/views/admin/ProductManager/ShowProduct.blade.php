@extends('admin.index')

@section('content')

<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Danh sách sản phẩm</h3>
            </div>
            <a href="{{ route('ProductManager.CreateProduct') }}" style="width:200px; margin-left:30px;" class="btn btn-primary mt-2 mb-2">Thêm sản phẩm mới</a>
            @if (session('success'))
                <div class="alert alert-success ms-3" id="success-alert">
                    {{ session('success') }}
                </div>
            @endif
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Danh mục</th>
                    <th>Tên sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Số lượng</th>
                    <th>Giá gốc</th>
                    <th>Giá bán</th>
                    <th>Giảm giá</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->name_product }}</td>
                            <td>
                                @if($product->image_product)
                                    <img src="{{ asset('images/' . $product->image_product) }}" alt="{{ ( $product->image_product) }}" style="width: 50px; height: 50px; object-fit: cover;">
                                @endif
                            </td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ number_format($product->price, 0, ',', '.') }} <u>đ</u></td>
                            <td>{{ number_format($product->saleprice, 0, ',', '.') }} <u>đ</u></td>
                            <td>{{ $product->sale }}%</td>
                            <td>
                                <a href="{{ route('ProductManager.EditProduct', $product->id) }}" class="btn btn-warning">Cập nhật</a>
                                <form action="{{ route('ProductManager.Destroy', $product->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Xóa</button>
                                </form>
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
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
</section>

@endsection
