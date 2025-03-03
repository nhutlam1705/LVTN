@extends('admin.index')
@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>Cập nhật tài khoản</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('AccountManager.UpdateAccount', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="name">Họ và tên</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">
                </div>

                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">
                </div>

                <div class="form-group mb-3">
                    <label for="password">Mật khẩu mới</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Để trống nếu không muốn thay đổi">
                </div>

                <div class="form-group mb-3">
                    <label for="role">Vai trò</label>
                    <select name="role" id="role" class="form-control">
                        <option value="0" {{ $user->role == 0 ? 'selected' : '' }}>User</option>
                        <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="address">Địa chỉ</label>
                    <input type="text" name="address" id="address" class="form-control" value="{{ $user->address }}">
                </div>

                <div class="form-group mb-3">
                    <label for="phone">Số điện thoại</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ $user->phone }}">
                </div>

                <div class="form-group mb-3">
                    <label for="account_id">Loại tài khoản</label>
                    <select name="account_id" id="account_id" class="form-control">
                        @foreach($accounts as $account)
                            <option value="{{ $account->id }}" {{ $user->account_id == $account->id ? 'selected' : '' }}>{{ $account->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="image">Ảnh đại diện</label>
                    <input type="file" class="form-control" name="image" id="image">
                    @if($user->image)
                        <div class="mt-3">
                            <img src="{{ asset('images/' . $user->image) }}" alt="User Image" class="img-thumbnail" width="100">
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary w-100">Cập nhật</button>
            </form>
        </div>
    </div>
</div>
@endsection
