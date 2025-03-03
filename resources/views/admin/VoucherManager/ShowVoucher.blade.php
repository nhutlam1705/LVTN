@extends('admin.index')
@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Danh sách Voucher</h3>
            </div>
            <a href="{{ route('vouchers.create') }}" style="width:200px; margin-left:30px;" class="btn btn-primary mt-2 mb-2">Thêm Voucher</a>
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
                    <th>Mã Voucher</th>
                    <th>Mô tả</th>
                    <th>Giá trị giảm giá</th>
                    <th>Số lượng</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày kết thúc</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($vouchers as $voucher)
                      <tr>
                          <td>{{ $voucher->code }}</td>
                          <td>{{ $voucher->description_voucher }}</td>
                          <td>{{ $voucher->type == 'percent' ? $voucher->value . '%' : $voucher->value . 'đ' }}</td>
                          <td>{{ $voucher->usage_limit }}</td>
                          <td>{{ $voucher->start_date }}</td>
                          <td>{{ $voucher->end_date }}</td>
                          <td>
                              {{-- <a href="{{ route('vouchers.edit', $voucher->id) }}" class="btn btn-warning">Sửa</a> --}}
                              <form action="{{ route('vouchers.destroy', $voucher->id) }}" method="POST" style="display: inline-block;">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
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