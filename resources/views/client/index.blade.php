@extends("layout.client")
@section("banner")
    @if (session('success'))
        <script>
            new AWN().success('{{session('success')}}')
        </script>
    @endif
    @if (session('fail'))
        <script>
            new AWN().warning('{{session('fail')}}')
        </script>
    @endif
    <!-- ***** Main Banner Area Start ***** -->
    <div class="main-banner" id="top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-content">
                        <div class="thumb">
                            <div class="inner-content">
                                <h4>Thư viện GVB</h4>
                                <span>Tìm sách , thuê sách , mượn sách ngay tại đây</span>
                                <div class="main-border-button">
                                    <a href="{{route("products")}}">Khám phá ngay</a>
                                </div>
                            </div>
                            <img src="{{asset("assets/images/left-banner-image.jpg")}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="right-first-image">
                                    <div class="thumb">
                                        <div class="inner-content">
                                            <h4>Thư viện trường</h4>
                                            <span>Mượn sách trong thư viện GVB</span>
                                        </div>
                                        <div class="hover-content">
                                            <div class="inner">
                                                <h4>Thư viện trường</h4>
                                                <p>Lorem ipsum dolor sit amet, conservisii ctetur adipiscing elit
                                                    incid.</p>
                                                <div class="main-border-button">
                                                    <a href="{{route("products","thu-vien-truong.aspx")}}">Xem ngay</a>
                                                </div>
                                            </div>
                                        </div>
                                        <img src="{{asset("assets/images/baner-right-image-01.jpg")}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="right-first-image">
                                    <div class="thumb">
                                        <div class="inner-content">
                                            <h4>Sách của thành viên</h4>
                                            <span>Khám phá sách của thành viên</span>
                                        </div>
                                        <div class="hover-content">
                                            <div class="inner">
                                                <h4>Sách của thành viên</h4>
                                                <p>Thuê hoặc mượn sách của thành viên GVB-Library</p>
                                                <div class="main-border-button">
                                                    <a href="{{route("products","sach-cua-thanh-vien.aspx")}}">Xem
                                                        ngay</a>
                                                </div>
                                            </div>
                                        </div>
                                        <img src="{{asset("assets/images/baner-right-image-02.jpg")}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="right-first-image">
                                    <div class="thumb">
                                        <div class="inner-content">
                                            <h4>Sách miễn phí</h4>
                                            <span>Luôn Freee</span>
                                        </div>
                                        <div class="hover-content">
                                            <div class="inner">
                                                <h4>Sách miễn phí</h4>
                                                <p>Tìm mượn sách miễn phí (áp dụng cho hs THPT GVB)</p>
                                                <div class="main-border-button">
                                                    <a href="{{route("products","sach-mien-phi.aspx")}}">Xem ngay</a>
                                                </div>
                                            </div>
                                        </div>
                                        <img src="{{asset("assets/images/baner-right-image-03.jpg")}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="right-first-image">
                                    <div class="thumb">
                                        <div class="inner-content">
                                            <h4>Ebook - Sách online, sách nói</h4>
                                            <span>Dịch vụ mới</span>
                                        </div>
                                        <div class="hover-content">
                                            <div class="inner">
                                                <h4>Ebook - Sách online, sách nói</h4>
                                                <p>Lorem ipsum dolor sit amet, conservisii ctetur adipiscing elit
                                                    incid.</p>
                                                <div class="main-border-button">
                                                    <a href="{{route("products","ebook-va-sach-noi.aspx")}}">Xem
                                                        ngay</a>
                                                </div>
                                            </div>
                                        </div>
                                        <img src="{{asset("assets/images/baner-right-image-04.jpg")}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->
@endsection
@section("content")
    <!-- ***** Men Area Starts ***** -->
    <section class="section" id="men">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h2>Sách của thành viên mới nhất</h2>
                        {{--                        <span>Details to details is what makes Hexashop different from the other themes.</span>--}}
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="men-item-carousel">
                        <div class="owl-men-item owl-carousel">
                            @if($members!=null)
                                @foreach($members as $member)
                                    <div class="item">
                                        <div class="thumb">
                                            <div class="hover-content">
                                                <ul>
                                                    <li><a href="{{route("product",$member->slug)}}"><i
                                                                class="fa fa-eye"></i></a></li>
                                                    <li><a href="{{route("product",$member->slug)}}"><i
                                                                class="fa fa-heart"></i></a></li>
                                                    <li><a href="{{route("request.make",$member->slug)}}"><i class="fa fa-shopping-cart"></i></a></li>
                                                </ul>
                                            </div>
                                            <img src="{{$member->main_thumbnail}}" alt="">
                                        </div>
                                        <div class="down-content">
                                            <h4>{{$member->name}}</h4>
                                            <span>{{isset($member->price)?"Giá thuê:".number_format($member->price)." đ":"Mượn miễn phí"}}</span>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Men Area Ends ***** -->

    <!-- ***** Women Area Starts ***** -->
    <section class="section" id="women">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h2>Thư viện trường</h2>
                        {{--                        <span>Details to details is what makes Hexashop different from the other themes.</span>--}}
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="women-item-carousel">
                        <div class="owl-women-item owl-carousel">
                            @if($libraries!=null)
                                @foreach($libraries as $member)
                                    <div class="item">
                                        <div class="thumb">
                                            <div class="hover-content">
                                                <ul>
                                                    <li><a href="{{route("product",$member->slug)}}"><i
                                                                class="fa fa-eye"></i></a></li>
                                                    <li><a href="{{route("product",$member->slug)}}"><i
                                                                class="fa fa-heart"></i></a></li>
                                                    <li><a href="{{route("request.make",$member->slug)}}"><i class="fa fa-shopping-cart"></i></a></li>
                                                </ul>
                                            </div>
                                            <img src="{{$member->main_thumbnail}}" alt="">
                                        </div>
                                        <div class="down-content">
                                            <h4>{{$member->name}}</h4>
                                            <span>{{isset($member->price)?"Giá thuê:".number_format($member->price)." đ":"Mượn miễn phí"}}</span>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Women Area Ends ***** -->

    <!-- ***** Kids Area Starts ***** -->
    <section class="section" id="kids">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h2>Sách miễn phí - Luôn Free</h2>
                        {{--                        <span>Details to details is what makes Hexashop different from the other themes.</span>--}}
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="kid-item-carousel">
                        <div class="owl-kid-item owl-carousel">
                            @if($frees!=null)
                                @foreach($frees as $member)
                                    <div class="item">
                                        <div class="thumb">
                                            <div class="hover-content">
                                                <ul>
                                                    {{--                                                    <li><a href="{{route("product")}}"><i class="fa fa-eye"></i></a></li>--}}
                                                    {{--                                                    <li><a href="{{route("product")}}"><i class="fa fa-heart"></i></a></li>--}}
                                                                                                        <li><a href="{{route("request.make",$member->slug)}}"><i class="fa fa-shopping-cart"></i></a></li>
                                                </ul>
                                            </div>
                                            <img src="{{$member->main_thumbnail}}" alt="">
                                        </div>
                                        <div class="down-content">
                                            <h4>{{$member->name}}</h4>
                                            <span>{{isset($member->price)?"Giá thuê:".number_format($member->price)." đ":"Mượn miễn phí"}}</span>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            @if($frees_2!=null)
                                @foreach($frees_2 as $member)
                                    <div class="item">
                                        <div class="thumb">
                                            <div class="hover-content">
                                                <ul>
                                                    {{--                                                    <li><a href="{{route("product")}}"><i class="fa fa-eye"></i></a></li>--}}
                                                    {{--                                                    <li><a href="{{route("product")}}"><i class="fa fa-heart"></i></a></li>--}}
                                                    {{--                                                    <li><a href="{{route("product")}}"><i class="fa fa-shopping-cart"></i></a></li>--}}
                                                </ul>
                                            </div>
                                            <img src="{{$member->main_thumbnail}}" alt="">
                                        </div>
                                        <div class="down-content">
                                            <h4>{{$member->name}}</h4>
                                            <span>{{isset($member->price)?"Giá thuê:".number_format($member->price)." đ":"Mượn miễn phí"}}</span>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Kids Area Ends ***** -->

    <!-- ***** Explore Area Starts ***** -->
{{--    <section class="section" id="explore">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-6">--}}
{{--                    <div class="left-content">--}}
{{--                        <h2>Explore Our Products</h2>--}}
{{--                        <span>You are allowed to use this HexaShop HTML CSS template. You can feel free to modify or edit this layout. You can convert this template as any kind of ecommerce CMS theme as you wish.</span>--}}
{{--                        <div class="quote">--}}
{{--                            <i class="fa fa-quote-left"></i>--}}
{{--                            <p>You are not allowed to redistribute this template ZIP file on any other website.</p>--}}
{{--                        </div>--}}
{{--                        <p>There are 5 pages included in this HexaShop Template and we are providing it to you for--}}
{{--                            absolutely free of charge at our TemplateMo website. There are web development costs for--}}
{{--                            us.</p>--}}
{{--                        <p>If this template is beneficial for your website or business, please kindly <a rel="nofollow"--}}
{{--                                                                                                         href="https://paypal.me/templatemo"--}}
{{--                                                                                                         target="_blank">support--}}
{{--                                us</a> a little via PayPal. Please also tell your friends about our great website. Thank--}}
{{--                            you.</p>--}}
{{--                        <div class="main-border-button">--}}
{{--                            <a href="products.html">Discover More</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-6">--}}
{{--                    <div class="right-content">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-lg-6">--}}
{{--                                <div class="leather">--}}
{{--                                    <h4>Leather Bags</h4>--}}
{{--                                    <span>Latest Collection</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-6">--}}
{{--                                <div class="first-image">--}}
{{--                                    <img src="assets/images/explore-image-01.jpg" alt="">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-6">--}}
{{--                                <div class="second-image">--}}
{{--                                    <img src="assets/images/explore-image-02.jpg" alt="">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-6">--}}
{{--                                <div class="types">--}}
{{--                                    <h4>Different Types</h4>--}}
{{--                                    <span>Over 304 Products</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
    <!-- ***** Explore Area Ends ***** -->

    <!-- ***** Social Area Starts ***** -->
    <section class="section" id="social">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2>Review sách của Gvbrary</h2>
{{--                        <span>Details to details is what makes Hexashop different from the other themes.</span>--}}
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row images">
                @if(isset($reviews))
                    @foreach($reviews as $review)
                        <div class="col-2">
                            <div class="thumb">
                                <div class="icon">
                                    <a href="http://instagram.com">
                                        <h6>{{$review->name}}</h6>
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                </div>
                                <img src="{{$review->photo}}" alt="">
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <!-- ***** Social Area Ends ***** -->

    <!-- ***** Subscribe Area Starts ***** -->
    <div class="subscribe">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="section-heading">
                        <h2>Theo dõi chúng tôi để nhận nhiều ưu đãi</h2>
                        <span>Email của bạn sẽ không bị chia sẻ</span>
                    </div>
                    <form id="subscribe" action="" method="get">
                        <div class="row">
                            <div class="col-lg-5">
                                <fieldset>
                                    <input name="name" type="text" id="name" placeholder="Tên của bạn" required="">
                                </fieldset>
                            </div>
                            <div class="col-lg-5">
                                <fieldset>
                                    <input name="email" type="text" id="email" pattern="[^ @]*@[^ @]*"
                                           placeholder="Email của bạn" required="">
                                </fieldset>
                            </div>
                            <div class="col-lg-2">
                                <fieldset>
                                    <button type="submit" id="form-submit" class="main-dark-button"><i
                                            class="fa fa-paper-plane"></i></button>
                                </fieldset>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-6">
                            <ul>
                                <li>Địa chỉ:<br><span>Gia Lập - Gia Viễn - Ninh Bình</span></li>
                                <li>Điện thoại:<br><span>0229-3868-103</span></li>
                                <li>Văn phòng:<br><span>Trường THPT Gia Viễn B</span></li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul>
                                <li>Giờ hành chính:<br><span>07:30 AM - 9:30 PM Hàng ngày</span></li>
                                <li>Email:<br><span>thptgvb@gmail.com</span></li>
                                <li>Mạng xã hội:<br><span><a href="#">GVB</a>, <a href="#">Instagram</a>, <a
                                            href="#">Behance</a>, <a href="#">Linkedin</a></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Subscribe Area Ends ***** -->
@endsection
