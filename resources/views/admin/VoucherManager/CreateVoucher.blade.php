@extends('admin.index')

@section('content')
<div class="container">
        <h3>Danh sách Voucher</h3>
        <br>
    <form action="{{ route('vouchers.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="code">Mã Voucher:</label>
            <input type="text" name="code" id="code" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description_voucher">Mô tả:</label>
            <input type="text" name="description_voucher" id="description_voucher" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="value">Giá trị:</label>
            <input type="number" name="value" id="value" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="type">Loại:</label>
            <select name="type" id="type" class="form-control" required>
                <option value="percent">Phần trăm</option>
                <option value="fixed">Cố định</option>
            </select>
        </div>
        <div class="form-group">
            <label for="start_date">Ngày bắt đầu:</label>
            <input type="date" name="start_date" id="start_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="end_date">Ngày kết thúc:</label>
            <input type="date" name="end_date" id="end_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="usage_limit">Số lượng:</label>
            <input type="number" name="usage_limit" id="usage_limit" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Thêm voucher</button>
    </form>
</div>


@endsection