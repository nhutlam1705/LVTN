<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-2">
                <div class="header__logo">
                    <a href="{{ route('home') }}"><img src="{{ asset('images/logo.png') }}" alt="" style="width:50px;height:50px;"></a>
                </div>
            </div>
            <div class="col-lg-7 col-md-7">
                <nav class="header__menu mobile-menu">
                    <ul>
                        <li class="active"><a href="{{ route('home') }}">Trang chủ</a></li>
                        <li><a href="{{ route('introduce') }}">Giới thiệu</a></li>
                        <li><a href="{{ route('product') }}">Sản phẩm</a>
                            {{-- <ul class="dropdown">
                                @foreach ($categories as $category)
                                    <li>
                                        <a href="{{ route('product', ['category_id' => $category->id]) }}" 
                                        class="{{ request('category_id') == $category->id ? 'active' : '' }}">
                                        {{ $category->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul> --}}
                        </li>
                        <li><a href="{{ route('new') }}">Tin tức</a></li>
                        <li><a href="{{ route('contact') }}">Liên hệ</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="header__nav__option">
                    <a @if(Auth::check()) 
                        class="dropdown-toggle" 
                        id="userDropdown" 
                        role="button" 
                        data-bs-toggle="dropdown" 
                        aria-expanded="false"
                    @endif>
                        @if(Auth::check())
                            @if (Auth::user()->image)
                                <img src="{{ asset('images/' . Auth::user()->image) }}" alt="User Avatar" class="user-avatar">
                            @else
                                <img src="{{ asset('images/user.jpg') }}" class="user-avatar" alt="User Avatar">
                            @endif
                            {{ Auth::user()->name }}
                        @else
                            <a href="{{ route('login') }}"><i class="fas fa-user"></i></a>
                        @endif
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="userDropdown">
                        @if(Auth::check())
                            <li><a class="dropdown-item" href="#">Thông tin cá nhân</a></li>
                            <li>
                                @if (Auth::user()->role == 1)
                                    <a class="dropdown-item" href="{{ route('admin.home') }}">Quản lí thông tin</a>
                                @endif
                            </li>
                            {{-- <li>
                                <a class="dropdown-item" href="{{ route('user.orders.index') }}">Xem thông tin đặt hàng</a>
                            </li> --}}

                            <li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Đăng xuất</button>
                                </form>
                            </li>
                        @endif
                    </ul>
                    
                    <a href="{{ ('/cart') }}">
                        <i class="fas fa-shopping-cart cart-icon"></i>
                        <span id="cart-count">{{ session('cart') ? count(session('cart')) : 0 }}</span>
                    </a>
                    {{-- @if(session('cart'))
                       
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
                    @endif --}}
                    {{-- <a href="{{ route('login') }}" class="search-switch"><i class="fas fa-user"></i></a> --}} 
                </div>
            </div>
        </div>
        <div class="canvas__open"><i class="fa fa-bars"></i></div>
    </div>
</header>