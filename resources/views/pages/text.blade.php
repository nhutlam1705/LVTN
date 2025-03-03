<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gia Dụng Việt</title>
    <link rel="shortcut icon" href="{{ asset('images/logo.jpg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ ('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    @include('pages.header')
    @include('pages.menu')

    @include('pages.slide')  
    @yield('content')
    <div class="zalo-chat-widget" data-oaid="3325259691690915354" data-welcome-message="Rất vui khi được hỗ trợ bạn!" data-autopopup="0" data-width="" data-height=""></div>

    <script src="https://sp.zalo.me/plugins/sdk.js"></script>
    @include('pages.footer')
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
      function showFullscreenContent(event, contentId) {
        event.preventDefault(); // Ngăn chặn hành vi mặc định của thẻ a

        // Hiển thị nội dung fullscreen được chọn
        var selectedContent = document.getElementById(contentId);
        selectedContent.style.display = 'flex';
    }

    function closeFullscreenContent() {
        // Ẩn tất cả các nội dung fullscreen
        var contents = document.querySelectorAll('.fullscreen-content');
        contents.forEach(function(content) {
            content.style.display = 'none';
        });
    }
    // Đảm bảo nội dung ẩn đi khi trang tải lại
    document.addEventListener("DOMContentLoaded", function() {
        closeFullscreenContent(); // Ẩn nội dung ngay khi trang được tải
    });
</script>

{{-- <script>
    // JavaScript cho việc tương tác nếu cần thêm chức năng
    document.querySelector('.cart-icon').addEventListener('click', function() {
        alert('Đã nhấp vào giỏ hàng!');
    });
</script> --}}

<script type="text/javascript">
    $(document).ready(function(){
        // Khi người dùng nhấn vào nút Thêm vào giỏ
        $('.add-to-cart').click(function(e){
            e.preventDefault();

            var id = $(this).data('id');
            var url = '/cart/add/' + id;

            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response){
                    // Cập nhật số lượng giỏ hàng
                    $('#cart-count').text(response.totalItems);
                },
                error: function(){
                    alert('Có lỗi xảy ra, vui lòng thử lại.');
                }
            });
        });
    });
</script>
</html>


{{-- header --}}
<div class="header">
    <div class="row">
        <div class="col-lg-2">
           <a href="{{ ('pages/index') }}"><img src="{{ asset('images/logo.jpg') }}" alt="Logo" width="120px" height="100px"></a>
        </div>
        <div class="col-lg-6  mt-4">
            <div class="container">
                <form class="d-flex">
                  <input class="form-control me-2" type="search" placeholder="Tìm Kiếm" aria-label="Search">
                  <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="row">
                <nav class="navbar navbar-expand-lg ">
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                @if(Auth::check())
                                    <!-- Nếu người dùng đã đăng nhập -->
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            @if (Auth::user()->image)
                                            <img src="{{  asset('images/' . Auth::user()->image) }}" alt="User Avatar" class="user-avatar">
                                            @else
                                                <img src="{{ asset('images/user.jpg') }}" class="user-avatar" alt="User Avatar">
                                            @endif
                                            {{ Auth::user()->name }}
                                            
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                            <li><a class="dropdown-item" href="#">Thông tin cá nhân</a></li>
                                            <li>
                                                @if (Auth::user()->role == 1)
                                                    <a class="dropdown-item" href="{{ ('admin/home') }}">Quản lí thông tin</a>
                                                @endif
                                            </li>
                                            {{-- <li>
                                                @foreach ($orders as $order)
                                                <a href="{{ route('orders.show' , $order->id) }}">thông tin đơn hàng</a>
                                                @endforeach
                                            </li> --}}
                                            <li>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">Đăng xuất</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">
                                            <i class="bi bi-box-arrow-in-right"></i> Đăng nhập
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">
                                            <i class="bi bi-person-plus"></i> Đăng ký
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                </nav>
            </div>  
        </div>
    </div>
</div>


{{-- content --}}

<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{ asset('images/banner1.jpg') }}" class="d-block w-100" alt="Slide 1" style="height: 350px">
        <div class="carousel-caption d-none d-md-block">
          <h5>Slide 1 Title</h5>
          <p>Slide 1 Description.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="{{ asset('images/banner2.jpg') }}" class="d-block w-100" alt="Slide 2" style="height: 350px">
        <div class="carousel-caption d-none d-md-block">
          <h5>Slide 2 Title</h5>
          <p>Slide 2 Description.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="{{ asset('images/banner3.jpg') }}" class="d-block w-100" alt="Slide 3" style="height: 350px">
        <div class="carousel-caption d-none d-md-block">
          <h5>Slide 3 Title</h5>
          <p>Slide 3 Description.</p>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
</div>

<div class="container">
    <div class="marquee">
        <div class="marquee-content">
            Chào mừng đến với Website <b style="color: red;">Gia Dụng Việt</b> - Điểm đến tin cậy cho các sản phẩm điện gia dụng chất lượng cao!
        </div>
    </div>
</div>

<div class="container mt-3">
    <div class="row">
        <div class="col-lg-6">
            <h2>Về chúng tôi</h2>
            <h3>GIA DỤNG VIỆT</h3>
            <br>
            <p>Tại [Tên Website], chúng tôi tự hào mang đến cho bạn những thiết bị điện gia dụng hiện đại, tiết kiệm năng lượng và đáng tin cậy nhất. Với nhiều năm kinh nghiệm trong ngành, chúng tôi hiểu rõ nhu cầu của khách hàng và luôn nỗ lực để cung cấp các sản phẩm tốt nhất từ những thương hiệu hàng đầu.

                Dù bạn đang tìm kiếm các thiết bị nhà bếp, thiết bị vệ sinh, máy lạnh, hay các sản phẩm gia dụng thông minh, chúng tôi đều có những lựa chọn phong phú, đa dạng về kiểu dáng và chức năng, phù hợp với mọi không gian sống. Đội ngũ hỗ trợ chuyên nghiệp của chúng tôi luôn sẵn sàng tư vấn và hỗ trợ bạn trong việc chọn lựa sản phẩm phù hợp nhất với nhu cầu.
                
                Hãy trải nghiệm mua sắm trực tuyến dễ dàng, tiện lợi và an toàn tại [Tên Website] - nơi biến căn nhà của bạn trở nên tiện nghi và hiện đại hơn bao giờ hết!</p>
        </div>
        <div class="col-lg-6">
            <img src="{{ asset('images/GT.jpg') }}" alt="" style="height: 400px;">
        </div>
    </div>
</div>
<br>

<div class="container mt-3">
    <h3>MÃ KHUYẾN MÃI</h3>
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
                        <p>Giảm {{ number_format($voucher->discount_amount, 0, ',', '.') }}K cho đơn hàng</p>
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
                                <p class="col-4 text-danger">Ngày hết hạn: </p> <p class="col-8">{{ $voucher->valid_until }}</p>
                                <p class="col-4 text-danger">Số lượng: </p> <p class="col-8">{{ $voucher->usage_limit }}</p>
                                <p class="col-4 text-danger">Điều kiện:</p><p class="col-8">{{ $voucher->description_voucher }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="container mt-3">
    <h3>SIÊU SALE GIÁ RẺ</h3>
    <div class="row">
        <div class="col-4">
            <img src="{{ asset('images/GT.jpg') }}" alt="" style="width:100%; height:350px">
        </div>
        <div class="col-8">
            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <a href="#">
                            <img src="{{ asset('images/product1.jpg') }}" class="card-img-top" alt="Image 1" style="height: 200px">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">Quạt Điện MaSaKa</h5>
                            <p><s style="color: grey">1.200.000<u>đ</u></s> <b style="margin-left: 10px"> 980.000<u>đ</u></b></p>
                            <a href="#" class="btn btn-primary">Thêm vào giỏ</a>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<section class="section_product">
    <div class="container mt-3">
        <div class="title">
            <h2 class="title-module">
                <a href="#" title="Quà tặng sinh nhật">Sản phẩm mới nhất</a>
            </h2>
                <a class="see_more" href="{{ ('/') }}" title="Xem thêm">Xem thêm</a>
        </div>
        <div class="row">
            @foreach($products as $product)
            <div class="col-3">
                <div class="card">
                    <a href="#">
                        <img src="{{ asset('images/' . $product->image_product) }}" class="card-img-top" alt="{{ asset('images/' . $product->image_product) }}" style="height: 200px">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name_product }}</h5>
                        <p><b style="margin-left: 10px">{{ number_format($product->saleprice , 0, ',', '.') }}<u>đ</u></b></p>
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
                        </form>
                    </div>

                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<section class="section_product section_product_1">
        <div class="container">
            <div class="title">
                <h2 class="title-module">
                    <a href="#" title="Quà tặng sinh nhật">Sản Phẩm giảm giá</a>
                </h2>
                <a class="see_more" href="{{ ('/') }}" title="Xem thêm">Xem thêm</a>
            </div>
            <div class="row load-after" data-section="section_product_1">
                @foreach($productsale as $product)
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 col-12">
                    <div class="item_product_main">
    
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="variants product-action item-product-main duration-300" data-cart-form="" data-id="product-actions-34641978" enctype="multipart/form-data">
                            @csrf
                           
                            <span class="flash-sale">{{ $product->sale }}%</span>
                            <div class="product-thumbnail">
                                <a href="#" class="image_thumb scale_hover">
                                    <img src="{{ asset('images/' . $product->image_product) }}"  class="card-img-top" alt="Image 1" style="height: 200px">
                                </a>
                            </div>
                            <div class="product-info">
                                <div class="name-price">
                                    <h3 class="product-name line-clamp-2-new">
                                        <a href="#" title="">{{ $product->name_product }}</a>
                                    </h3>
                                    <div class="product-price-cart">
                                        {{-- <span class="compare-price">{{ number_format($product->saleprice , 0, ',', '.') }}</span>
                        
                                        <span class="price">{{ number_format($product->saleprice - ($product->saleprice*$product->sale /100)  , 0, ',', '.') }}</span> --}}
                                        <p class="text-align-center">
                                            <s style="color: grey">{{ number_format($product->saleprice , 0, ',', '.') }}<u>đ</u></s>
                                             <b style="margin-left: 10px">{{ number_format($product->saleprice - ($product->saleprice*$product->sale /100)  , 0, ',', '.') }}<u>đ</u></b>
                                        </p>
                                    </div>
                                </div>
                                <div class="info-bottom">
                                    <span class="bottom-border-left"></span>
                                    <span class="bottom-border-right"></span>
                                    <div class="product-button">
                                        <input type="hidden" name="variantId" value="110380640">
                                        <button class="btn-cart btn-views add_to_cart btn btn-primary " title="Thêm vào giỏ">
                                            <span>Thêm vào giỏ</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                           
                        </form>				
                    </div>
                </div>	
                @endforeach
            </div>
        </div>
</section>
</div>


{{-- checkout --}}
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thông tin thanh toán</title>
    <script src="https://js.stripe.com/v3/"></script>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<style>
    .paymentBox{
        padding: 10px;
        border: 1px solid black;
        box-shadow: 10%;
        border-radius: 10px;

    }
</style>
<body>
    <div class="container">
        <div class="d-flex justify-content-center">
            <img src="{{ asset('images/logo.jpg') }}" alt="" style="width:200px; height:200px;">
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="paymentBox">
                    <h2>Thông tin người dùng</h2>
                    <p>Tên: {{ $userInfo['name'] }}</p>
                    <p>Email: {{ $userInfo['email'] }}</p>
                    <p>Địa chỉ: {{ $userInfo['address'] }}</p>
                    <p>Điện thoại: {{ $userInfo['phone'] }}</p>
                </div>

            </div>
            <div class="col-lg-4">
                <div class="paymentBox">
                    <h2>Phương thức thanh toán</h2>
                    <form action="{{ route('payment.process') }}" method="POST">
                        @csrf
                        <label>
                            <input type="radio" name="payment_method" value="stripe" checked>
                            <img src="{{ asset('images/logo_Striper.png') }}" alt="" style="width:50px;height:50px;">
                            Stripe
                        </label><br>
                        <label>
                            <input type="radio" name="payment_method" value="momo">
                            <img src="{{ asset('images/logo_MoMo.png') }}" alt="" style="width:50px;height:50px;">
                            MoMo
                        </label><br>
                        {{-- <label>
                            <input type="radio" name="payment_method" value="paypal">
                            PayPal
                        </label><br> --}}
                        <label>
                            <input type="radio" name="payment_method" value="vnpay">
                            <img src="{{ asset('images/logo_VNpay.png') }}" alt="" style="width:50px;height:50px;">
                            VNPay
                        </label><br>
                        <label>
                            <input type="radio" name="payment_method" value="cod">
                            Thanh toán khi nhận hàng
                        </label><br><br>
                        <button type="submit">Xác nhận thanh toán</button>
                    </form>
                
                    @if (Session::has('success'))
                    <p style="color: green;">{{ Session::get('success') }}</p>
                    @endif
                
                    @if ($errors->any())
                    <p style="color: red;">{{ $errors->first() }}</p>
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="paymentBox">
                    <h2>Thông tin đơn hàng</h2>
                    <ul>
                        @foreach ($cartItems as $item)
                            <li>
                                <img src="{{ asset('images/' . $item['image']) }}" width="50" height="50">
                                {{ $item['name'] }} - 
                                {{ $item['quantity'] }} - 
                                {{ number_format($item['saleprice'], 0, ',', '.') }} VND
                            </li>
                        @endforeach
                    </ul>
                    <form action="" method="POST">
                         {{-- {{ route('applyDiscount') }} --}}
                        @csrf <!-- Include CSRF token for security -->
                        <div class="form-group">
                            <div class="row">
                                <label for="discount_code">Mã giảm giá:</label>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="discount_code" name="discount_code" placeholder="Nhập mã giảm giá">
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-primary">Áp dụng</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row alert alert-info mt-3">
                        <strong>Tổng tiền:</strong><p>{{ number_format($total, 0, ',', '.') }} <u>VND</u></p>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @if (Session::has('success'))
        <p style="color: green;">{{ Session::get('success') }}</p>
    @endif
</body>
</html>
