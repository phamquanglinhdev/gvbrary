@extends("layout.client")
@section("banner")
    <!-- ***** Main Banner Area Start ***** -->
    <div class="page-heading" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content">
                        <h2>{{$product->name}}</h2>
{{--                        <span>Awesome &amp; Creative HTML CSS layout by TemplateMo</span>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->
@endsection
@section("content")
    <!-- ***** Product Area Starts ***** -->
    <section class="section" id="product">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="left-images">
                        <img src="{{$product->first_thumbnail}}" alt="">
                        <img src="{{$product->second_thumbnail}}" alt="">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="right-content">
                        <h4>{{$product->name}}</h4>
                        <span class="price">{{isset($product->price)?number_format($product->price)." đ":"Miễn phí"}}</span>
{{--                        <ul class="stars">--}}
{{--                            <li><i class="fa fa-star"></i></li>--}}
{{--                            <li><i class="fa fa-star"></i></li>--}}
{{--                            <li><i class="fa fa-star"></i></li>--}}
{{--                            <li><i class="fa fa-star"></i></li>--}}
{{--                            <li><i class="fa fa-star"></i></li>--}}
{{--                        </ul>--}}
                        <span>{!! $product->description !!}</span>
{{--                        <div class="quote">--}}
{{--                            <i class="fa fa-quote-left"></i><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiuski smod.</p>--}}
{{--                        </div>--}}
{{--                        <div class="quantity-content">--}}
{{--                            <div class="left-content">--}}
{{--                                <h6>No. of Orders</h6>--}}
{{--                            </div>--}}
{{--                            <div class="right-content">--}}
{{--                                <div class="quantity buttons_added">--}}
{{--                                    <input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button" value="+" class="plus">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        @if(backpack_auth()->check())
                            <div class="total">
                                <h4>Thuê: {{isset($product->price)?number_format($product->price)." đ":"Miễn phí"}}</h4><br>
                                @if(!isset($product->price) && backpack_user()->role>2)
                                    <br><div class="text-danger d-block">*Ấn phẩm miễn phí áp dụng cho thành viên trường THPT GVB</div>
                                    <div class="main-border-button d-block w-100"><a href="#">Xác minh thành viên</a></div>
                                @else
                                    <br><div class="text-danger d-block">*Ấn phẩm miễn phí áp dụng cho thành viên trường THPT GVB</div>
                                    <div class="main-border-button d-block w-100"><a href="#">Thêm vào giỏ sách</a></div>
                                @endif

                            </div>
                        @else
                            <br><div class="text-danger d-block">*Đăng nhập đế mua sản phẩm</div>
                            <a class="text-white" href="{{route("backpack.auth.login")}}"><div class="btn btn-outline-secondary d-block w-100">Đăng nhập</div></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Product Area Ends ***** -->
@endsection
