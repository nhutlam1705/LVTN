@extends('admin.index')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Cập nhật sản phẩm</h1>
    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('ProductManager.UpdateProduct', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="category_id" class="font-weight-bold">Loại danh mục</label>
                    <select name="category_id" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @if($category->id == $product->category_id) selected @endif>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="name_product" class="font-weight-bold">Tên sản phẩm</label>
                    <input type="text" name="name_product" class="form-control" value="{{ $product->name_product }}" placeholder="Nhập tên sản phẩm">
                </div>

                <div class="form-group">
                    <label for="image" class="font-weight-bold">Hình ảnh</label>
                    <div class="mb-3">
                        @if($product->image_product)
                            <img src="{{ asset('images/' . $product->image_product) }}" alt="Hình ảnh sản phẩm" class="img-thumbnail" style="height: 100px; width: 100px;">
                        @else
                            <p>Không có hình ảnh</p>
                        @endif
                    </div>
                    <input type="file" name="image_product" class="form-control-file">
                </div>

                <div class="form-group">
                    <label for="quantity" class="font-weight-bold">Số lượng</label>
                    <input type="number" name="quantity" class="form-control" value="{{ $product->quantity }}" placeholder="Nhập số lượng">
                </div>

                <div class="form-group">
                    <label for="description_product" class="font-weight-bold">Mô tả</label>
                    <textarea name="description_product" class="form-control" rows="5" placeholder="Nhập mô tả sản phẩm">{{ $product->description_product }}</textarea>
                </div>

                <div class="form-group">
                    <label for="price" class="font-weight-bold">Giá gốc</label>
                    <input type="number" name="price" class="form-control" value="{{ $product->price }}" placeholder="Nhập giá gốc">
                </div>

                <div class="form-group">
                    <label for="saleprice" class="font-weight-bold">Giá bán</label>
                    <input type="number" name="saleprice" class="form-control" value="{{ $product->saleprice }}" placeholder="Nhập giá bán">
                </div>

                <div class="form-group">
                    <label for="sale" class="font-weight-bold">Giảm giá (%)</label>
                    <input type="number" name="sale" class="form-control" value="{{ $product->sale }}" placeholder="Nhập % giảm giá">
                </div>

                <button type="submit" class="btn btn-primary btn-block mt-4">Cập nhật</button>
            </form>
        </div>
    </div>
</div>
@endsection
