@extends('pages.index')
@section('content')
<style>
        .container {
            padding: 20px;
            max-width: 1200px;
            margin: auto;
        }
        .contact-info, .contact-form {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }
        .contact-info h3, .contact-form h3{
            margin-bottom: 10px;
        }
        .contact-info {
            justify-content: space-between;
        }
        .info-item {
            flex: 1;
            min-width: 300px;
            margin: 10px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .map {
            flex: 2;
            min-width: 300px;
            margin: 10px;
            padding: 0;
        }
        .map iframe {
            width: 100%;
            height: 700px;
            border: none;
            border-radius: 8px;
        }
        .form-group {
            margin-bottom: 15px;
            flex: 1 1 100%;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input, .form-group textarea, .form-group button {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-group textarea {
            resize: none;
            height: 120px;
        }
        .form-group button {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }
        .form-group button:hover {
            background-color: #0056b3;
        }
        @media (max-width: 768px) {
            .contact-info {
                flex-direction: column;
            }
            .info-item, .map {
                flex: 1 1 100%;
            }
        }
</style>
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Liên hệ</h4>
                    <div class="breadcrumb__links">
                        <a href="{{ route('home') }}">Trang chủ</a>
                        <span>Liên hệ</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="map">
                    <<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1431.8555729614043!2d105.92599118829797!3d9.54288275697092!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a052d905e26eb5%3A0x8054f8760319927f!2zUXXDoW4gQ8OgIFBow6ogR2nhuqNpIEtow6F0IE5n4buNYyBEdW5n!5e0!3m2!1svi!2s!4v1732814980786!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="contact-info">
                    <div class="info-item">
                        <h3>Thông tin liên hệ</h3>
                        <p>Địa chỉ: 56, ấp Đại Thành, xã Đại Tâm, huyện Mỹ Xuyên, tỉnh Sóc Trăng</p>
                        <p>Email: nhutlam1705@gmail.com</p>
                        <p>Điện thoại: (+84)388 297 119</p>
                        <p>Thời gian làm việc: 8h00 - 17h00 (Thứ 2 - Thứ 7)</p>
                    </div>
                </div>
                <form action="{{ route('contact.store') }}" method="POST">
                    <h3>Gửi thắc mắc cho chúng tôi</h3>
                    @csrf
                    <div class="contact-form">
                        <div class="form-group">
                            <label for="name">Your Name</label>
                            <input type="text" id="name" name="name" placeholder="Nhập tên của bạn"  
                            value="{{ $userInfo ? $userInfo->name : '' }}"   
                            {{ $userInfo ? 'readonly' : '' }} required>
                        </div>
                        <div class="form-group">
                            <label for="email">Your Email</label>
                            <input type="email" id="email" name="email"  value="{{ $userInfo ? $userInfo->email : '' }}" 
                            placeholder="Nhập email của bạn" 
                            {{ $userInfo ? 'readonly' : '' }} required>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" placeholder="Write your message" required></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit">Gửi</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection