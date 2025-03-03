@extends('admin.index')
@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Danh sách tin tức & sự kiện</h3>
            </div>
            <a href="{{ route('InformationManager.CreateInformation') }}" style="width:200px; margin-left:30px;" class="btn btn-primary mt-2 mb-2">Thêm tin tức & sự kiện</a>
            {{-- <button id="openFormButton">Thêm Sản Phẩm</button>
            <div id="overlay"></div>
            <div id="addProductForm">
            </div> --}}
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
                    <th>ID</th>
                    <th>Loại Thông tin</th>
                    <th>Thumbnail</th>
                    <th>Tiêu đề</th>
                    <th>Mô tả</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($informations as $info)
                        <tr>
                            <td>{{ $info->id }}</td>
                            <td>{{ $info->type }}</td>
                            <td>
                                @if( $info->thumbnail )
                                    <img src="{{ asset('images/' . $info->thumbnail) }}" alt="" style="width: 50px; height: 50px; object-fit: cover;">
                                @endif
                            </td>
                            <td>{{ $info->title }}</td>
                            <td>{{ Str::limit($info->description_information, 50) }}</td>
                            <td>
                                <a href="{{ route('InformationManager.Edit', $info->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                <form action="{{ route('InformationManager.Destroy', $info->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
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
