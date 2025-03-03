{{-- @extends('pages.index')
@section('content')
    <div class="container mt-4">
        <h5>Giỏ hàng của bạn</h5>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(!empty($cart) && count($cart) > 0)
            <table class="table table-bordered">
                <thead class="bg-danger">
                    <tr class="bg-secondary">
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Giá gốc</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $id => $item)
                        <tr>
                            <td><img src="{{ asset('images/' . $item['image']) }}" width="50" height="50"></td>
                            <td>{{ $item['name'] }}</td>
                            <td>
                                 <!-- Form để cập nhật số lượng -->
                                <form action="{{ route('cart.show') }}" method="GET" style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $id }}">
                                    <input type="hidden" name="quantity" value="{{ $item['quantity'] - 1 }}">
                                    <button type="submit" class="btn btn-outline-secondary btn-sm">-</button>
                                </form>

                                <span>{{ $item['quantity'] }}</span>

                                <form action="{{ route('cart.show') }}" method="GET" style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $id }}">
                                    <input type="hidden" name="quantity" value="{{ $item['quantity'] + 1 }}">
                                    <button type="submit" class="btn btn-outline-secondary btn-sm">+</button>
                                </form>
                            </td>
                            <td>{{ number_format($item['saleprice'], 0, ',', '.') }} <u>đ</u></td>
                            <td>{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} <u>đ</u></td>
                            <td>
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-lg-8">
                    <button style="width:180px; height:50px; border-radius:10px;">
                        <a href="{{ ('/') }}" class="text-decoration-none">Tiếp tục mua hàng</a>
                    </button>
                </div>
                <div class="col-lg-4">
                    <div class="row alert alert-info">
                        <strong>Tổng tiền:</strong><p>{{ number_format($total, 0, ',', '.') }} <u>đ</u></p>
                        <strong>Tổng tiền:</strong><p>{{ number_format($original, 0, ',', '.') }} <u>đ</u></p>
                    </div>
                    <form action="{{ route('checkout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-danger w-100 m-auto" style="height:70px;  border-radius:10px;">
                            Thanh toán
                        </button> 
                    </form>
                      
                </div>
            </div>
        @else
            <p>Giỏ hàng của bạn đang trống.</p>
        @endif
    </div>
@endsection --}}

@extends('pages.index')
@section('content')
 <!-- Breadcrumb Section Begin -->
 <section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Giỏ hàng của bạn</h4>
                    <div class="breadcrumb__links">
                        <a href="./index.html">Trang chủ</a>
                        <a href="./shop.html">Sản phẩm</a>
                        <span>Giỏ hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
@if(!empty($cart) && count($cart) > 0)
<!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Tổng</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cart as $id => $item)
                                <tr>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__pic">
                                            <img src="{{ asset('images/' . $item['image']) }}" width="50" height="50">
                                        </div>
                                        <div class="product__cart__item__text">
                                            <h6>{{ $item['name'] }}</h6>
                                            <h5>
                                                @if($item['sale'] > 0)
                                                    <s style="color: grey">{{ number_format($item['saleprice'] , 0, ',', '.') }}<u>đ</u></s>
                                                    {{ number_format(($item['saleprice']-($item['saleprice']*$item['sale']/100)) , 0, ',', '.') }}<u>đ</u>
                                                @else
                                                    {{ number_format($item['saleprice'] , 0, ',', '.') }} <u>đ</u>
                                                @endif
                                            </h5>
                                        </div>
                                    </td>
                                    <td class="quantity__item">
                                        <div class="quantity">
                                            <div class="pro-qty-2">
                                                <input type="number" class="quantity-input" data-id="{{ $item['product_id'] }}" value="{{ $item['quantity'] }}"  min="1">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart__price">
                                        @if($item['sale'] > 0)
                                            {{ number_format(($item['saleprice']-($item['saleprice']*$item['sale']/100)) * $item['quantity'] , 0, ',', '.') }}<u>đ</u>
                                        @else
                                            {{ number_format($item['saleprice'] * $item['quantity'], 0, ',', '.') }} <u>đ</u>
                                        @endif
                                    </td>
                                    <td class="cart__close">
                                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="round-button"> <i class="fas fa-close"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="{{ route('home') }}">Tiếp tục mua hàng</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <a href="#"><i class="fa fa-spinner"></i> Cập nhật giỏ hàng</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart__discount">
                        <h6>Mã giảm giá</h6>
                        <form action="{{ route('apply-voucher') }}" method="POST">
                            @csrf
                            <input type="text" placeholder="Nhập mã giảm giá" name="voucher_code">
                            <button type="submit">Áp dụng</button>
                        </form>
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">{{ $errors->first('voucher_code') }}</div>
                        @endif
                        {{-- <p>Tổng tiền: {{ number_format(session('cart_total', 0)) }} đ</p> --}}
                      
                    </div>
                    <div class="cart__total">
                        <h6>Cart total</h6>
                        <ul>
                            <li>Tạm tính <span>{{ number_format($total, 0, ',', '.') }} <u>đ</u></span></li>
                            <li>Giảm giá <span>{{ number_format(session('discount', 0)) }} <u>đ</u></span></li>
                            <li>Tổng tiền <span id="total-price">{{ number_format(session('cart_total', $total)) }} <u>đ</u></span></li>
                        </ul>
                        {{-- <a href="#" class="primary-btn">Thanh toán</a> --}}
                        <form action="{{ route('checkout') }}" method="POST">
                            @csrf
                            <button type="submit" class="primary-btn">Thanh toán</button> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@else
    <p>Giỏ hàng của bạn đang trống.</p>
@endif
<!-- Shopping Cart Section End -->
@endsection