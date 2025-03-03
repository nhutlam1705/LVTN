@extends('pages.index')

@section('content')
<style>
    .breadcrumb-option {
        background-color: #f8f9fa;
        padding: 15px 0;
    }

    .breadcrumb__text h4 {
        font-size: 1.75rem;
        font-weight: bold;
    }

    .breadcrumb__links a {
        color: #6c757d;
        text-decoration: none;
        margin-right: 5px;
    }

    .breadcrumb__links a:hover {
        text-decoration: underline;
    }

    .breadcrumb__links span {
        color: #212529;
    }

    .product-title {
        font-size: 2rem;
        font-weight: bold;
        color: #333;
    }

    .product-price {
        font-size: 1.5rem;
        color: #e63946;
        font-weight: bold;
    }

    .product-description {
        font-size: 1rem;
        line-height: 1.6;
        color: #495057;
    }

    .product-image img {
        max-height: 500px;
        width: 100%;
        object-fit: contain;
        border-radius: 8px;
    }

    @media (max-width: 768px) {
        .product-image img {
            max-height: 300px;
        }
    }

    .list-unstyled li {
        margin-bottom: 8px;
        font-size: 0.95rem;
    }

    .input-group input[type="number"] {
        max-width: 60px;
    }

    .btn-primary {
        background-color: #ff6f61;
        border-color: #ff6f61;
    }

    .btn-primary:hover {
        background-color: #ff3b2f;
        border-color: #ff3b2f;
    }

    .btn-secondary {
        color: #fff;
        background-color: #6c757d;
        border-color: #6c757d;
    }
</style>

<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Sản phẩm</h4>
                    <div class="breadcrumb__links">
                        <a href="{{ route('home') }}">Trang chủ</a>
                        <a href="{{ route('product') }}">Sản phẩm</a>
                        <span>{{ $product->name_product }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container my-5">
    <div class="row">
        <!-- Product Image -->
        <div class="col-md-6">
            <div class="product-image">
                <img src="{{ asset('images/' . $product->image_product) }}" class="img-fluid" alt="{{ $product->name_product }}">
            </div>
        </div>

        <!-- Product Details -->
        <div class="col-md-6">
            <h1 class="product-title">{{ $product->name }}</h1>
            <p class="text-muted">Mã sản phẩm: {{ $product->id ?? 'N/A' }}</p>
            <h4 class="product-price">{{ number_format($product->price, 0, ',', '.') }} đ</h4>

            <ul class="list-unstyled">
                <li><strong>Tên sản phẩm:</strong> {{ $product->name_product }}</li>
                <li><strong>Danh mục:</strong> {{ $product->category->name ?? 'Không có' }}</li>
                <li><strong>Số lượng có sẵn:</strong> {{ $product->quantity }}</li>
            </ul>

            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-4">
                @csrf
                <div class="input-group mb-3">
                    <input type="number" name="quantity" class="form-control" min="1" value="1" required>
                    <button class="btn btn-primary">Thêm vào giỏ hàng</button>
                </div>
            </form>

            <div class="mt-3">
                <a href="{{ route('product') }}" class="btn btn-secondary">Quay lại danh sách sản phẩm</a>
            </div>
        </div>
        <p><strong>Mô tả sản phẩm: </strong></p>
        <p class="product-description mt-4">{{ $product->description_product }}</p>
    </div>

    <!-- Product Reviews -->
    <div class="row mt-5">
        <div class="col-12">
            <h3>Đánh giá sản phẩm</h3>
            <p>Hiện chưa có đánh giá nào cho sản phẩm này.</p>
        </div>
    </div>
</div>
@endsection
