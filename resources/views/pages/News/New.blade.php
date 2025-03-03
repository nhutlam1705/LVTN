@extends('pages.index')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Tin tức</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route('home') }}">Trang chủ</a>
                            <span>Tin tức</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <div class="container mt-3">
        <section class="latest spad">
            <div class="container">
                <div class="row">
                    <h3 class="text-danger">Các tin tức liên quan</h3>
                    <div class="separator"></div>
                </div>
                <div class="row">
                    @foreach ($informations as $info)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="blog__item">
                            <div class="blog__item__pic set-bg" data-setbg="{{ asset('images/' . $info->thumbnail) }}"></div>
                            <div class="blog__item__text">
                                <span>
                                    <img src="img/icon/calendar.png" alt="">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    Đăng ngày: 
                                    {{ $info->created_at->format('d/m/Y') }}
                                </span>
                                <h5 class="title">{{ $info->title }}</h5>
                                <a href="{{ route('news.show', $info->id) }}">Xem thêm</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection