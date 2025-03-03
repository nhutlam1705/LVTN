
<!-- Remove the container if you want to extend the Footer to full width. -->
{{-- <div class="footer mt-3">
    <!-- Footer -->
    <footer
            class="text-center text-lg-start text-white"
            style="background-color: #dd1515"
            >
      <!-- Grid container -->
      <div class="container p-4 pb-0">
        <!-- Section: Links -->
        <section class="">
          <!--Grid row-->
          <div class="row">
            <!-- Grid column -->
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
              <h5 class="text-uppercase mb-4 font-weight-bold">
               Thế Giới Điện Gia Dụng Việt
              </h5>
                <img class="d-block mx-auto" src="{{ asset('images/logo.jpg') }}" style="width:100px;height:100px; clip-path:circle(50% at 50% 50%);" alt="">
              <p class="mt-1">
                Tự hào mang đến cho bạn những thiết bị điện gia dụng hiện đại, tiết kiệm năng lượng và đáng tin cậy nhất.
              </p>
            </div>
            <!-- Grid column -->
  
            <hr class="w-100 clearfix d-md-none" />
  
            <!-- Grid column -->
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
              <h6 class="text-uppercase mb-4 font-weight-bold">Thông tin khác</h6>
              <p>
                <a class="text-white">Hỗ trợ khách hàng</a>
              </p>
              <p>
                <a class="text-white">Chính sách ưu đãi</a>
              </p>
              <p>
                <a class="text-white"></a>
              </p>
              <p>
                <a class="text-white">Chính sách bảo mật</a>
              </p>
            </div>
            <!-- Grid column -->
  
            <hr class="w-100 clearfix d-md-none" />
  
            <!-- Grid column -->
            <hr class="w-100 clearfix d-md-none" />
  
            <!-- Grid column -->
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
              <h6 class="text-uppercase mb-4 font-weight-bold">Liên Hệ</h6>
              <p><i class="fas fa-home mr-3"></i> 56, Đại Thành, Đại Tâm, Mỹ Xuyên, Sóc Trăng</p>
              <p><i class="fas fa-envelope mr-3"></i> thegioigiadung@gmail.com</p>
              <p><i class="fas fa-phone mr-3"></i> + 84 382 020 318</p>
              <p><i class="fas fa-print mr-3"></i> + 84 234 567 890</p>
            </div>
            <!-- Grid column -->
  
            <!-- Grid column -->
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
              <h6 class="text-uppercase mb-4 font-weight-bold">Hỗ Trợ Thanh Toán</h6>
                <a
                    class="btn btn-primary btn-floating m-1"
                    style="background-color: #fafafa"
                    href="#!"
                    role="button"
                    ><img src="{{ asset('images/logo_Striper.png') }}" style="width:30px;height:20px;" alt="">
                </a>
                <a
                    class="btn btn-primary btn-floating m-1"
                    style="background-color: #fafafa"
                    href="#!"
                    role="button"
                    ><img src="{{ asset('images/logo_MoMo.png') }}" style="width:30px;height:20px;" alt="">
                </a>
                <a
                    class="btn btn-primary btn-floating m-1"
                    style="background-color: #fafafa"
                    href="#!"
                    role="button"
                    ><img src="{{ asset('images/logo_VNpay.png') }}" style="width:30px;height:20px;" alt="">
                </a>
              
              <h6 class="text-uppercase mb-4 font-weight-bold">Theo dõi chúng tôi</h6>
  
              <!-- Facebook -->
              <a
                 class="btn btn-primary btn-floating m-1"
                 style="background-color: #3b5998"
                 href="#!"
                 role="button"
                 ><i class="fab fa-facebook-f"></i
                ></a>
  
              <!-- Twitter -->
              <a
                 class="btn btn-primary btn-floating m-1"
                 style="background-color: #55acee"
                 href="#!"
                 role="button"
                 ><i class="fab fa-twitter"></i
                ></a>
  
              <!-- Google -->
              <a
                 class="btn btn-primary btn-floating m-1"
                 style="background-color: #dd4b39"
                 href="#!"
                 role="button"
                 ><i class="fab fa-google"></i
                ></a>
  
              <!-- Instagram -->
              <a
                 class="btn btn-primary btn-floating m-1"
                 style="background-color: #ac2bac"
                 href="#!"
                 role="button"
                 ><i class="fab fa-instagram"></i
                ></a>
  
              <!-- Linkedin -->
              <a
                 class="btn btn-primary btn-floating m-1"
                 style="background-color: #0082ca"
                 href="#!"
                 role="button"
                 ><i class="fab fa-linkedin-in"></i
                ></a>
              <!-- Github -->
              <a
                 class="btn btn-primary btn-floating m-1"
                 style="background-color: #333333"
                 href="#!"
                 role="button"
                 ><i class="fab fa-github"></i
                ></a>
            </div>
          </div>
          <!--Grid row-->
        </section>
        <!-- Section: Links -->
      </div>
      <!-- Grid container -->
  
      <!-- Copyright -->
      <div
           class="text-center p-3"
           style="background-color: rgba(0, 0, 0, 0.2)"
           >
        © 2024 Copyright:
        <a class="text-white" href="http://127.0.0.1:8000/"
           >thegioidiengiadungviet.com</a
          >
      </div>
      <!-- Copyright -->
    </footer>
    <!-- Footer -->
</div> --}}



<footer class="footer mt-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__logo">
                        <a href="{{ route('home') }}"><img src="{{ asset('images/logo.png') }}" alt="" class="d-block mx-auto" style="width:100px;height:100px; clip-path:circle(50% at 50% 50%);" ></a>
                    </div>
                    <p>The customer is at the heart of our unique business model, which includes design.</p>
                    <a href="#">
                      <img src="{{ asset('images/logo_MoMo.png') }}" alt="" style="width:40px; height:40px;">
                      <img src="{{ asset('images/logo_VNpay.png') }}" alt="" style="width:40px; height:40px;">
                      <img src="{{ asset('images/logo_Striper.png') }}" alt="" style="width:60px; height:40px;">
                    </a>
                </div>
            </div>
            <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                <div class="footer__widget">
                    <h6>Shopping</h6>
                    <ul>
                        <li><a href="#">Clothing Store</a></li>
                        <li><a href="#">Trending Shoes</a></li>
                        <li><a href="#">Accessories</a></li>
                        <li><a href="#">Sale</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6">
                <div class="footer__widget">
                    <h6>Shopping</h6>
                    <ul>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Payment Methods</a></li>
                        <li><a href="#">Delivary</a></li>
                        <li><a href="#">Return & Exchanges</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-6">
                <div class="footer__widget">
                    <h6>NewLetter</h6>
                    <div class="footer__newslatter">
                        <p>Be the first to know about new arrivals, look books, sales & promos!</p>
                        <form action="#">
                            <input type="text" placeholder="Your email">
                            <button type="submit"><span class="icon_mail_alt"></span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="footer__copyright__text">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    <p>Copyright ©
                        <script>
                            document.write(new Date().getFullYear());
                        </script>2020
                        All rights reserved | This template is made with <i class="fa fa-heart-o"
                        aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                    </p>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Search Begin -->
<div class="search-model">
  <div class="h-100 d-flex align-items-center justify-content-center">
      <div class="search-close-switch">+</div>
      <form class="search-model-form">
          <input type="text" id="search-input" placeholder="Search here.....">
      </form>
  </div>
</div>
<!-- Search End -->
