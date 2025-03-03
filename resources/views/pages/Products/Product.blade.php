@extends('pages.index')
@section('content')
     <!-- Breadcrumb Section Begin -->
     <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Sản phẩm</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route('home') }}">Trang chủ</a>
                            <span>Sản phẩm</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop__sidebar">
                        <div class="shop__sidebar__search">
                            <form action="{{ route('product') }}" method="GET">
                                <input type="text" name="keyword" placeholder="Search..." value="{{ request('keyword') }}">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div>
                        <div class="shop__sidebar__accordion">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseOne">Danh mục</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                <ul class="nice-scroll">
                                                    @foreach ($categories as $category)
                                                        <li>
                                                            <a href="{{ route('product', ['category_id' => $category->id]) }}" 
                                                            class="{{ request('category_id') == $category->id ? 'active' : '' }}">
                                                            {{ $category->name }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseThree">Filter Price</a>
                                    </div>
                                    <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__price">
                                                <ul>
                                                    <li>
                                                        <a href="{{ route('product', ['min_price' => 0, 'max_price' => 100000]) }}" 
                                                           class="{{ request('min_price') == 0 && request('max_price') == 100000 ? 'active' : '' }}">
                                                           0 đ - 100.000 đ
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('product', ['min_price' => 100000, 'max_price' => 500000]) }}" 
                                                           class="{{ request('min_price') == 100000 && request('max_price') == 500000 ? 'active' : '' }}">
                                                           100.000 đ - 500.000 đ
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('product', ['min_price' => 500000, 'max_price' => 1000000]) }}" 
                                                           class="{{ request('min_price') == 500000 && request('max_price') == 1000000 ? 'active' : '' }}">
                                                           500.000 đ - 1.000.000 đ
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('product', ['min_price' => 1000000, 'max_price' => 2000000]) }}" 
                                                           class="{{ request('min_price') == 1000000 && request('max_price') == 2000000 ? 'active' : '' }}">
                                                           1.000.000 đ - 2.000.000 đ
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('product', ['min_price' => 2000000, 'max_price' => 5000000]) }}" 
                                                           class="{{ request('min_price') == 2000000 && request('max_price') == 5000000 ? 'active' : '' }}">
                                                           2.000.000 đ - $5.000.000 đ
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('product', ['min_price' => 5000000]) }}" 
                                                           class="{{ request('min_price') == 5000000 ? 'active' : '' }}">
                                                           5.000.000 đ+
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="shop__product__option">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__left">
                                    <p>Showing 1–12 of 126 results</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__right">
                                    <p>Sort by Price:</p>
                                    <select>
                                        <option value="">Low To High</option>
                                        <option value="">$0 - $55</option>
                                        <option value="">$55 - $100</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        
                        @foreach($products as $product)
                        <div class="col-lg-4 col-md-6 col-sm-6">
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
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product__pagination">
                                <a class="active" href="#">1</a>
                                <a href="#">2</a>
                                <a href="#">3</a>
                                <span>...</span>
                                <a href="#">21</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->
@endsection