<div class="menu bg-danger">
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-6">
            <ul class="row">
                <li class="col-lg-1"></li>
                <li class="col-lg-2"><a href="{{ ('/') }}">Trang Chủ</a></li>
                <li class="col-lg-2"><a href="{{ route('product') }}">Giới Thiệu</a></li>
                <li class="col-lg-2"><a href="{{ ('/sanpham') }}">Sản Phẩm</a></li>
                <li class="col-lg-2"><a href="{{ ('/tintuc') }}">Tin Tức</a></li>
                <li class="col-lg-2"><a href="{{ ('/lienhe') }}">Liên Hệ</a></li>
                <li class="col-lg-1"></li>
            </ul>
        </div>
        <div class="col-lg-4">
            <div class="cart-container m-3" style="left: 50%">
                <a href="{{ ('/cart') }}">
                    <i class="fas fa-shopping-cart cart-icon"></i>
                    <span id="cart-count">{{ session('cart') ? count(session('cart')) : 0 }}</span>
                </a>
                @if(session('cart'))
                   
                        <div class="cart-content">
                            @foreach($cart as $id => $item)
                            <div class="cart-item">
                                <img src="{{ asset('images/' . $item['image']) }}" alt="Product">
                                <p class="m-1">{{ $item['name'] }}</p>
                                <p class="m-1">{{ $item['quantity'] }}</p>
                                <p class="m-1">{{ number_format($item['price'], 0, ',', '.') }} đ</p>
                            </div>
                            @endforeach
                            <div class="row mt-2 mb-2">
                                <div class="col-6">
                                    <h6>Tổng tiền: </h6>
                                    <span>{{ number_format($total, 0, ',', '.') }} đ</span>
                                </div>
                                <div class="col-6 m-auto">
                                    <button class="bg-danger w-100" style="border-radius:10px; height:50px;">
                                        <strong class="m-auto">
                                            <a href="{{ route('payment.info') }}" style="text-decoration:none; color:aliceblue;">Thanh toán</a>
                                        </strong>
                                    </button>
                                </div>
                            </div>
                        </div>
                @endif
            </div>
        </div>   
    </div>
</div>