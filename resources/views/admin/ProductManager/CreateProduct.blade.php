@extends('admin.index')

@section('content')
<div class="container">
    <h2>Thêm sản phẩm mới</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <h4 class="mt-5">Thêm Danh Mục Mới</h4>
    <form action="{{ route('ProductManager.StoreCategory') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="category_name" class="form-label">Tên Danh Mục</label>
            <input type="text" class="form-control" id="category_name" name="name" required>
        </div>
        <button type="submit" class="btn btn-success">Thêm Danh Mục</button>
    </form>
    <form action="{{ route('ProductManager.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Tên sản phẩm: </label>
            <input type="text" name="name_product" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Danh Mục</label>
            <select class="form-select" id="category_id" name="category_id">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="description">Mô tả:</label>
            <textarea name="description_product" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="quantity">Số lượng: </label>
            <input type="number" name="quantity" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="price">Giá gốc: </label>
            <input type="number" name="price" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="sale_price">Giá bán: </label>
            <input type="number" name="saleprice" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="sale">Giảm giá: </label>
            <input type="number" name="sale" class="form-control">
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Hình Ảnh</label>
            <input type="file" class="form-control" id="image" name="image_product" required>
        </div>

        <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
    </form>
</div>
@endsection
