@extends('admin.index')
@section('content')

<div class="container">
    <h2>Thêm Tài Khoản User</h2>
    <form action="{{ route('AccountManager.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Trường Name -->
        <div class="form-group">
            <label for="name">Tên:</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <!-- Trường Email -->
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <!-- Trường Role -->
        <div class="form-group">
            <label for="role">Vai trò:</label>
            <select name="role" class="form-control" required>
                <option value="0" {{ old('role') == 0 ? 'selected' : '' }}>User</option>
                <option value="1" {{ old('role') == 1 ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <!-- Trường Address -->
        <div class="form-group">
            <label for="address">Địa chỉ:</label>
            <input type="text" name="address" class="form-control" value="{{ old('address') }}">
        </div>

        <!-- Trường Phone -->
        <div class="form-group">
            <label for="phone">Số điện thoại:</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
        </div>

        <!-- Trường Tài khoản -->
        <div class="form-group">
            <label for="account">Tài khoản:</label>
            <select name="account" class="form-control">
                <option value="">Chọn tài khoản</option>
                @foreach($accounts as $account)
                    <option value="{{ $account->id }}">{{ $account->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Trường Ảnh đại diện -->
        <div class="form-group">
            <label for="image">Hình ảnh:</label>
            <input type="file" name="image" class="form-control">
        </div>

        <!-- Trường Password -->
        <div class="form-group">
            <label for="password">Mật khẩu:</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <!-- Trường Xác nhận Password -->
        <div class="form-group">
            <label for="password_confirmation">Xác nhận mật khẩu:</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <!-- Nút Submit -->
        <button type="submit" class="btn btn-primary">Thêm tài khoản</button>
    </form>
</div>

@endsection