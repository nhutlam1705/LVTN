@extends('admin.index')
@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Danh sách tài khoản</h3>
            </div>
            <a href="{{ route('AccountManager.CreateAccount') }}" style="width:200px; margin-left:30px;" class="btn btn-primary mt-2 mb-2">Thêm tài khoản mới</a>
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
                  <th>Họ & Tên</th>
                  <th>Hình ảnh</th>
                  <th>Email</th>
                  <th>SĐT</th>
                  <th>Địa chỉ</th>
                  <th>Loại tài khoản</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr class="even">
                        <td class="sorting_1 dtr-control">{{ $user->name }}</td>
                        <td> 
                            <div class="user-image">
                                @if($user->image)
                                    <img src="{{ asset('images/' . $user->image) }}" alt="User Image" style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <p>Chưa có hình ảnh.</p>
                                @endif
                            </div>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ $user->account->name}}</td>
                        <td>
                            <a href="{{ route('AccountManager.EditAccount', $user->id) }}" class="btn btn-warning">Sửa</a>
                            <form action="{{ route('AccountManager.Destroy', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa tài khoản này?')">Xóa</button>
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

{{-- card khác --}}
{{-- <div class="card">
            <div class="card-header">
              <h3 class="card-title">DataTable with minimal features & hover style</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Rendering engine</th>
                  <th>Browser</th>
                  <th>Platform(s)</th>
                  <th>Engine version</th>
                  <th>CSS grade</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>Trident</td>
                  <td>Internet
                    Explorer 4.0
                  </td>
                  <td>Win 95+</td>
                  <td> 4</td>
                  <td>X</td>
                </tr>
                <tr>
                  <td>Misc</td>
                  <td>IE Mobile</td>
                  <td>Windows Mobile 6</td>
                  <td>-</td>
                  <td>C</td>
                </tr>
                <tr>
                  <td>Misc</td>
                  <td>PSP browser</td>
                  <td>PSP</td>
                  <td>-</td>
                  <td>C</td>
                </tr>
                <tr>
                  <td>Other browsers</td>
                  <td>All others</td>
                  <td>-</td>
                  <td>-</td>
                  <td>U</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                  <th>Rendering engine</th>
                  <th>Browser</th>
                  <th>Platform(s)</th>
                  <th>Engine version</th>
                  <th>CSS grade</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
</div> --}}