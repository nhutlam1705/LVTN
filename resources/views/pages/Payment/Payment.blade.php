
@extends('pages.index')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Check Out</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Home</a>
                            <a href="./shop.html">Shop</a>
                            <span>Check Out</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    
    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form action="#">
                    <div class="row">
                        <div class="col-lg-7 col-md-6">
                            <h6 class="coupon__code"><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click
                            here</a> to enter your code</h6>
                            <h6 class="checkout__title">Chi tiết thanh toán</h6>
                            {{-- <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Fist Name<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div>
                            </div> --}}
                            <div class="checkout__input">
                                <p>Tên khách hàng<span>*</span></p>
                                <input type="text" value="{{ $userInfo['name'] }}">
                            </div>
                            <div class="checkout__input">
                                <p>Địa chỉ<span>*</span></p>
                                <input type="text" placeholder="Street Address" class="checkout__input__add" value="{{ $userInfo['address'] }}">
                                {{-- <input type="text" placeholder="Apartment, suite, unite ect (optinal)"> --}}
                            </div>
                            {{-- <div class="checkout__input">
                                <p>Email<span>*</span></p>
                                <input type="text" value="{{ $userInfo['email'] }}">
                            </div>
                            <div class="checkout__input">
                                <p>Số điện thoại<span>*</span></p>
                                <input type="text" value="{{ $userInfo['phone'] }}">
                            </div> --}}
                            {{-- <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input type="text">
                            </div> --}}
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" value="{{ $userInfo['phone'] }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" value="{{ $userInfo['email'] }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Đơn hàng của bạn</h4>
                                <div class="checkout__order__products">
                                    <div class="row">
                                        <div class="col-2">Ảnh</div>
                                        <div class="col-5">Thiết bị</div>
                                        <div class="col-1">SL</div>
                                        <div class="col-4">Đơn giá</div>
                                    </div>
                                
                                </div>
                                @foreach ($cartItems as $item)
                                <ul class="checkout__total__products">
                                    <li>
                                        <div class="row">
                                            <div class="col-2"><img src="{{ asset('images/' . $item['image']) }}" width="40" height="40"></div>
                                            <div class="col-5"> {{ $item['name'] }}</div>
                                            <div class="col-1">{{ $item['quantity'] }}</div>
                                            <div class="col-4">
                                                @if($item['sale'] > 0)
                                                    {{ number_format(($item['saleprice']-($item['saleprice']*$item['sale']/100)) * $item['quantity'] , 0, ',', '.') }}<u>đ</u>
                                                @else
                                                    {{ number_format($item['saleprice'] * $item['quantity'], 0, ',', '.') }} <u>đ</u>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                @endforeach
                                <ul class="checkout__total__all">
                                    {{-- <li>Subtotal <span>$750.99</span></li> --}}
                                    <li>Tạm tính <span>{{ number_format($total, 0, ',', '.') }} <u>đ</u></span></li>
                                    <li>Giảm giá <span> {{ number_format(session('discount', 0)) }} <u>đ</u></span></li>
                                    <li>Tổng tiền <span id="total-price">{{ number_format(session('cart_total', $total)) }} <u>đ</u></span></li>
                                </ul>
                                <form action="{{ route('payment.vnpay') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="site-btn" name="redirect">
                                        Thanh toán VNPay
                                    </button>
                                </form>
                                <form action="{{ route('payment.stripe') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="site-btn">
                                        Thanh toán Stripe
                                    </button>
                                </form>
                                <form action="{{ route('payment.cod') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="site-btn">
                                        Thanh toán khi nhận hàng
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <style>
        .bet{
            align-items: center
        }
    </style>
    <!-- Checkout Section End -->
@endsection
