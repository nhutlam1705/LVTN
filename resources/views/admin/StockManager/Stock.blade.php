@extends('admin.index')

@section('content')

<style>
  form{
    text-align: center;
  }
</style>
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Danh sách sản phẩm trong kho</h3>
            </div>
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
                        <th>Tên sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Đang bán</th>
                        <th>Trong kho</th>
                        <th>Nhập kho</th>
                        <th>Xuất kho</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->name_product }}</td>
                            <td>
                                @if($product->image_product)
                                    <img src="{{ asset('images/' . $product->image_product) }}" alt="{{ ( $product->image_product) }}" style="width: 50px; height: 50px; object-fit: cover;">
                                @endif
                            </td>
                            <td>
                              Số lượng: {{ $product->quantity }}
                              <br><br>
                              Giá gốc: {{ $product->price }}
                              <br><br>
                              Giá bán: {{ $product->saleprice }} 
                            </td>
                            <td>
                              @if(isset($stock[$product->id]))
                                  Số lượng: {{ $stock[$product->id]->quantity_stock }} <br><br>
                                  Giá gốc: {{ $stock[$product->id]->price_stock }} <br><br>
                                  Giá bán: {{ $stock[$product->id]->saleprice_stock }}
                              @else
                                  Chưa có dữ liệu nhập kho
                              @endif
                            </td>
                            <td>
                                <form action="{{ route('stocks.in', $product->id) }}" method="POST">
                                    @csrf
                                    <div class="row">
                                      <div class="col-4"><label for="">Số Lượng: </label></div>
                                      <div class="col-7"> <input type="number" name="quantity_stock" min="1" required></div>
                                      <div class="col-1"></div>
                                    </div>
                                    <div class="row">
                                      <div class="col-4"><label for="">Giá gốc: </label></div>
                                      <div class="col-7"><input type="number" name="price_stock" min="1" required></div>
                                      <div class="col-1"></div>
                                    </div>
                                    <div class="row">
                                      <div class="col-4"><label for="">Giá bán: </label></div>
                                      <div class="col-7">  <input type="number" name="saleprice_stock" min="1" required></div>
                                      <div class="col-1"></div>
                                    </div>
                                    <div class="row">
                                      <div class="col-4"></div>
                                      <div class="col-8"><button type="submit">Nhập kho</button></div>
                                    </div>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('stocks.out', $product->id) }}" method="POST">
                                    @csrf
                                    <div class="row">
                                      <div class="col-4"><label for="">Số Lượng: </label></div>
                                      <div class="col-7"><input type="number" name="quantity_stock" min="1" max="{{ $product->stock }}" required></div>
                                      <div class="col-1"></div>
                                    </div>
                                    <div class="row">
                                      <div class="col-4"></div>
                                      <div class="col-8"><button type="submit">Xuất kho</button></div>
                                    </div>
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
