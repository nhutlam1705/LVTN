@extends('pages.index')
@section('content')
<style>
    .h2{
        font-family: 'Dancing Script', cursive;
        text-align: center;
    }
    .h3{
        color: red;
        font-weight: bold;
        text-align: center;
    }
    /* Container cho các box */
    .icon-box-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 20px;
        margin: 20px 0;
    }

    /* Style cho từng box */
    .icon-box {
        flex: 1 1 22%; /* Mỗi box chiếm 1 phần trong 4 box */
        box-sizing: border-box;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 10px;
        text-align: center;
        background-color: #f9f9f9;
        transition: all 0.3s ease;
    }

    /* Các icon trong box */
    .icon-box .icon {
        font-size: 40px;
        margin-bottom: 15px;
        color: #3498db;
    }

    /* Tiêu đề và mô tả */
    .icon-box h5 {
        font-size: 18px;
        color: #333;
        margin-bottom: 10px;
    }

    .icon-box p {
        font-size: 14px;
        color: #777;
    }

    /* Hover effect */
    .icon-box:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .icon-box {
            flex: 1 1 48%; /* Khi màn hình nhỏ, mỗi box chiếm 2 phần */
        }
    }

    @media (max-width: 480px) {
        .icon-box {
            flex: 1 1 100%; /* Khi màn hình rất nhỏ, mỗi box chiếm toàn bộ chiều rộng */
        }
    }
</style>
<!-- Hero Section Begin -->
<section class="hero">
    <div class="hero__slider owl-carousel">
        <div class="hero__items set-bg" data-setbg="{{ asset('dist/img/boxed-bg.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero__text">
                            <h6>SẢN PHẨM MỚI</h6>
                            <h2>NỒI CƠM ĐIỆN WALLSHAP</h2>
                            <p>Nồi cơm điện Wallshap đã có mặt tại Shop với giá cực sốc</p>
                            <a href="{{ route('product') }}" class="primary-btn">MUA NGAY<span class="arrow_right"></span></a>
                            <div class="hero__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-0 col-md-0"></div>
                    <div class="col-xl-5 col-lg-5 col-md-4">
                        <img src="{{ asset('images/noicomdien.png') }}" alt="">

                    </div>
                </div>
            </div>
        </div>
        <div class="hero__items set-bg" data-setbg="{{ asset("dist/img/boxed-bg.png") }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero__text">
                            <h6>SẢN PHẨM MỚI</h6>
                            <h2>BÀN LÀ ĐIỆN SUNHOUSE</h2>
                            <p>Sản phẩm bán chạy nhất</p>
                            <a href="{{ route('product') }}" class="primary-btn">MUA NGAY<span class="arrow_right"></span></a>
                            <div class="hero__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-0 col-md-0">
                    </div>
                    <div class="col-xl-5 col-lg-5 col-md-4">
                        <img src="{{ asset('images/banla.png') }}" alt="">

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<div class="icon-box-container">
    <div class="icon-box">
        <div class="icon"><i class="fas fa-truck"></i></div>
        <h5>Miễn phí vận chuyển</h5>
        <p>Miễn phí vận chuyển cho mọi hóa đơn trên toàn quốc</p>
    </div>
    <div class="icon-box">
        <div class="icon"><i class="fas fa-gift"></i></div>
        <h5>Quà tặng</h5>
        <p>Hóa đơn trên 500.000 VNĐ</p>
    </div>
    <div class="icon-box">
        <div class="icon"><i class="fas fa-certificate"></i></div>
        <h5>Chứng nhận chất lượng</h5>
        <p>Sản phẩm chính hãng</p>
    </div>
    <div class="icon-box">
        <div class="icon"><i class="fas fa-phone-alt"></i></div>
        <h5>Hotline: 1900 6750</h5>
        <p>Hỗ trợ 24/7</p>
    </div>
</div>

<section>
    <div class="container mt-3">
        @foreach ($information as $information)
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
                <h2 class="h2">Về chúng tôi</h2>
                <h3 class="h3">{{ $information->title }}</h3>
                <br>
                <p>{!! Str::limit(strip_tags($information->description_information), 600, '...')  !!}</p>
                <a href="{{ route('introduce') }}" class="primary-btn">Xem thêm <span class="arrow_right"></span></a>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <img src="{{ asset('images/' . $information->thumbnail) }}" alt="" style="height: 400px;">
            </div>
        </div>
        @endforeach
    </div>
</section>


<div class="container mt-3">
    <h3 class="h3">MÃ KHUYẾN MÃI</h3>
    <p style=" text-align-center;">Khuyến mãi dành cho khách hàng mua sắm</p>
    <div class="row">
        @foreach($vouchers as $voucher)
        <div class="col-lg-4">
            <div class="code">
                <div class="row">
                    <div class="col-4">
                        <img src="{{ asset('images/GT.jpg') }}" alt="" 
                        style="height:70px; width:70px;  border-radius: 10px; margin: 15px">
                    </div>
                    <div class="col-8 mt-1">
                        <h6>Nhập Mã: {{ $voucher->code }}</h6>
                        <p>{{ $voucher->description_voucher }}</p>
                        <div class="row">
                            <div class="col-6">
                                Sao Chép
                            </div>
                            <div class="col-6">
                                <a href="#" class="text-primary" onclick="showFullscreenContent(event, 'content1')">Điều kiện</a>
                            </div>
                        </div>
                    </div>
                    <div id="content1" class="fullscreen-content">
                        <div class="box-content">
                            <div class="row bg-danger">
                                <h5 class="col-11">Thông tin voucher</h5>
                                <div class="col-1">
                                    <span class="close-btn" onclick="closeFullscreenContent()">x</span>
                                </div>
                            </div>
                            <div class="row" style="background-color: white;">
                                <p class="col-4 text-danger">Mã giảm giá: </p> <p class="col-8">{{ $voucher->code }}</p>
                                <p class="col-4 text-danger">Ngày hết hạn: </p> <p class="col-8">{{ $voucher->end_date }}</p>
                                <p class="col-4 text-danger">Số lượng: </p> <p class="col-8">{{ $voucher->usage_limit }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Product Section Begin -->
<section class="product spad mt-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="filter__controls">
                    <li class="active" data-filter="*">Sản phẩm mới nhất</li>
                    <li data-filter=".new-arrivals">Các sản phẩm khác</li>
                    <li data-filter=".hot-sales">Sản phẩm giảm giá</li>
                </ul>
            </div>
        </div>
        <div class="row product__filter">
            @foreach($products as $product)
                <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix @if($product->sale > 0) hot-sales @else new-arrivals @endif">
                    <div class="product__item">
                        <a href="{{ route('product.show', $product->id) }}">
                        <div class="product__item__pic set-bg" data-setbg="{{ asset('images/' . $product->image_product) }}">
                            @if($product->sale > 0)
                                <span class="label">{{ $product->sale }}%</span>
                            @endif
                        </div>
                        </a>
                        <div class="product__item__text">
                            <h6>{{ $product->name_product }}</h6>
                            <a href="#" class="add-cart">
                                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit">+ Thêm vào giỏ hàng</button>
                                </form>
                            </a>
                            
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <h5>
                                @if($product->sale > 0)
                                    <s style="color: grey">{{ number_format($product->saleprice , 0, ',', '.') }}<u>đ</u></s>
                                    {{ number_format($product->saleprice- ($product->saleprice*$product->sale /100) , 0, ',', '.') }}<u>đ</u>
                                @else
                                    {{ number_format($product->saleprice , 0, ',', '.') }}<u>đ</u>
                                @endif
                            </h5>
                            <div class="product__color__select">
                                <label for="pc-1">
                                    <input type="radio" id="pc-1">
                                </label>
                                <label class="active black" for="pc-2">
                                    <input type="radio" id="pc-2">
                                </label>
                                <label class="grey" for="pc-3">
                                    <input type="radio" id="pc-3">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Product Section End -->

<!-- Latest Blog Section Begin -->
<section class="latest spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>Tin tức & Sự kiện</span>
                    <h2>Tin tức</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($informations as $info)
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="{{ asset('images/' . $info->thumbnail) }}"></div>
                    <div class="blog__item__text">
                        <span><img src="{{ asset('images/calendar.png') }}" alt="">{{ $info->created_at }}</span>
                        <h5 class="title">{{ $info->title }}</h5>
                        <a href="{{ route('news.show', $info->id) }}">Xem thêm</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Latest Blog Section End -->
@endsection