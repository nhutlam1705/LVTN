<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Điện gia dụng</title>
    <link rel="shortcut icon" href="{{ asset('images/logo.jpg') }}" type="image/x-icon">
    {{-- <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('css/elegant-icons.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    {{-- <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__option">
            <div class="offcanvas__links">
                <a href="#">Sign in</a>
                <a href="#">FAQs</a>
            </div>
            <div class="offcanvas__top__hover">
                <span>Usd <i class="arrow_carrot-down"></i></span>
                <ul>
                    <li>USD</li>
                    <li>EUR</li>
                    <li>USD</li>
                </ul>
            </div>
        </div>
        <div class="offcanvas__nav__option">
            <a href="#" class="search-switch"><img src="img/icon/search.png" alt=""></a>
            <a href="#"><img src="img/icon/heart.png" alt=""></a>
            <a href="#"><img src="img/icon/cart.png" alt=""> <span>0</span></a>
            <div class="price">$0.00</div>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__text">
            <p>Free shipping, 30-day return or refund guarantee.</p>
        </div>
    </div> --}}
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    @include('pages.header')
    <!-- Header Section End -->

    @yield('content')

    <div class="zalo-chat-widget" data-oaid="3325259691690915354" data-welcome-message="Rất vui khi được hỗ trợ bạn!" data-autopopup="" data-width="" data-height=""></div>

    <script src="https://sp.zalo.me/plugins/sdk.js"></script>

    <!-- Footer Section Begin -->
    @include('pages.footer')
    <!-- Footer Section End -->
    <button id="scrollToTopBtn" class="scroll-to-top">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Js Plugins -->
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('js/mixitup.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <script>
        // Lắng nghe sự kiện cuộn
        window.addEventListener("scroll", function () {
            const header = document.querySelector(".header");
            if (window.scrollY > 50) {
                // Thêm class 'scrolled' khi cuộn xuống hơn 50px
                header.classList.add("scrolled");
            } else {
                // Gỡ bỏ class 'scrolled' khi cuộn về đầu
                header.classList.remove("scrolled");
            }
        });
    </script>

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

    <script>
        // Lấy phần tử nút
        const scrollToTopBtn = document.getElementById("scrollToTopBtn");

        // Lắng nghe sự kiện cuộn
        window.addEventListener("scroll", function () {
            // Hiển thị nút khi cuộn xuống hơn 300px
            if (window.scrollY > 300) {
                scrollToTopBtn.style.display = "flex";
            } else {
                scrollToTopBtn.style.display = "none";
            }
        });

        // Sự kiện khi nhấn vào nút
        scrollToTopBtn.addEventListener("click", function () {
            // Cuộn về đầu trang
            window.scrollTo({
                top: 0,
                behavior: "smooth", // Cuộn mượt
            });
        });

    </script>

    <script>
        $(document).ready(function () {
            $('.filter__controls li').click(function () {
                const filterValue = $(this).data('filter');
                
                // Thêm class "active" cho filter đang chọn
                $('.filter__controls li').removeClass('active');
                $(this).addClass('active');

                // Lọc sản phẩm
                if (filterValue === '*') {
                    $('.product__filter .mix').show(); // Hiển thị tất cả
                } else {
                    $('.product__filter .mix').hide(); // Ẩn tất cả
                    $(`.product__filter ${filterValue}`).show(); // Hiển thị các phần tử phù hợp
                }
            });
        });

    </script>

    <script>
        document.querySelectorAll('.quantity-input').forEach(input => {
            input.addEventListener('change', function () {
                const productId = this.dataset.id; // Lấy ID sản phẩm
                const quantity = this.value; // Lấy số lượng mới

                fetch('/cart', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        id: productId,
                        quantity: quantity
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.status === 'success') {
                        // Cập nhật tổng giá tiền
                        document.querySelector('#total-price').innerText = `${data.total.toLocaleString()}đ`;
                        // Cập nhật lại giỏ hàng
                        updateCart(data.cart);
                    }
                });
            });
        });
        function updateCart(cart) {
            // Cập nhật giỏ hàng (nếu cần thiết)
            cart.forEach(item => {
                const quantityInput = document.querySelector(`.quantity-input[data-id='${item.product_id}']`);
                if (quantityInput) {
                    quantityInput.value = item.quantity;
                }
            });
        }

    </script>
</body>

</html>