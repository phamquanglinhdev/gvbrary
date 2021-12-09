<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
          rel="stylesheet">

    <title>{{isset($title)?"GVB Library-".$title:"GVB Library - Book everywhere"}}</title>


    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/bootstrap.min.css")}}">

    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/font-awesome.css")}}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>

    <link rel="stylesheet" href="{{asset("assets/css/templatemo-hexashop.css")}}">

    <link rel="stylesheet" href="{{asset("assets/css/owl-carousel.css")}}">

    <link rel="stylesheet" href="{{asset("assets/css/lightbox.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/style.css")}}">
    <script src="{{asset("assets/js/index.var.js")}}"></script>
</head>

<body>

<!-- ***** Preloader Start ***** -->
<div id="preloader">
    <div class="jumper">
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>
<!-- ***** Preloader End ***** -->


<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav row">
                    <!-- ***** Logo Start ***** -->
                    <a href="{{route("index")}}" class="d-lg-block d-none logo col-md-3 col-12">
                        <img src="{{asset("assets/images/logo.png")}}" class="w-100">
                    </a>
                    <a href="{{route("index")}}" class="d-lg-none d-block logo col-md-3 col-12">
                        <img src="{{asset("assets/images/logo.png")}}" class="w-50">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav col-md-9 col-12">
                        <li class="scroll-to-section"><a href="{{route("index")}}" class="active">Trang chủ</a></li>
                        <li class="submenu">
                            <a href="javascript:;">Danh sách</a>
                            <ul>
                                @php
                                    $categories =  \App\Models\Category::get();
                                @endphp
                                @foreach($categories as $category)
                                    <li><a href="{{route("products",$category->slug)}}">{{$category->name}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:;">Dịch vụ</a>
                            <ul>
                                <li><a href="#">Thuê sách</a></li>
                                <li><a href="#">Cho thuê sách</a></li>
                                <li><a href="#">Mượn sách miễn phí</a></li>
                                <li><a href="#">Xác mình học sinh GVB</a></li>
                            </ul>
                        </li>
                        @if(backpack_auth()->check())
                            <li class="submenu">
                                <a href="javascript:;"><i class="fas fa-user"></i> {{backpack_user()->name}}</a>
                                <ul>
                                    <li><a href="{{route("user.profile")}}">Thông tin tài khoản</a></li>
                                    <li><a href="#">Lịch sử tìm kiếm</a></li>
                                    <li><a href="#">Sách đã mượn (thuê)</a></li>
                                    <li><a href="{{route("backpack.auth.logout")}}">Đăng xuất</a></li>
                                    @if(backpack_user()->role<=1)
                                        <li><a href="#">Quản lý thanh toán</a></li>
                                        <li><a href="{{route("request.index")}}">Quản lý yêu cầu mượn sách</a></li>
                                    @endif
                                    @if(backpack_user()->role==0)
                                        <li><a href="{{route("backpack.dashboard")}}">Quản trị</a></li>
                                    @endif
                                </ul>
                            </li>
                            <li class=""><a href="#"><i
                                        class="fas fa-coins"></i> {{number_format(backpack_user()->coin)}} đ</a></li>
                            <li class=""><a href="{{route("cart")}}"><i class="fas fa-cart-plus"></i>
                                    <div class="badge badge-danger">0</div>
                                </a></li>
                        @else
                            <li><a href="{{route("backpack.auth.login")}}">Đăng nhập</a></li>
                            <li><a href="{{route("backpack.auth.register")}}">Đăng ký</a></li>
                        @endif
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- ***** Header Area End ***** -->
@yield("banner")
@yield("content")
<!-- ***** Footer Start ***** -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="first-item">
                    <div class="logo">
                        <img src="{{asset("assets/images/white-logo.png")}}" alt="hexashop ecommerce templatemo" class="w-75">
                    </div>
                    <ul>
                        <li><a href="#">Gia Lập, Gia Viễn, Ninh Bình</a></li>
                        <li><a href="mailto:thptgvb@gmail.com">thptgvb@gmail.com</a></li>
                        <li><a href="tel:02293868103">0229 3868 103</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3">
                <h4>Dịch vụ</h4>
                <ul>
                    <li><a href="#">Thuê sách</a></li>
                    <li><a href="#">Cho thuê sách</a></li>
                    <li><a href="#">Mượn sách miễn phí</a></li>
                    <li><a href="#">Xác minh học sinh GVB</a></li>
                </ul>
            </div>
            <div class="col-lg-3">
                <h4>Danh mục thông dụng</h4>
                <ul>
                    @foreach($categories as $category)
                        <li><a href="{{route("products",$category->slug)}}">{{$category->name}}</a></li>
                    @endforeach
{{--                    <li><a href="#">Homepage</a></li>--}}
{{--                    <li><a href="#">About Us</a></li>--}}
{{--                    <li><a href="#">Help</a></li>--}}
{{--                    <li><a href="#">Contact Us</a></li>--}}
                </ul>
            </div>
            <div class="col-lg-3">
                <h4>Tính năng</h4>
                <ul>

                    <li><a href="{{route("contact")}}">Liên hệ</a></li>
                    <li><a href="{{route("about")}}">Về chúng tôi</a></li>
                    <li><a href="#">Giỏ hàng</a></li>
                    <li><a href="#">Nạp coin</a></li>
                </ul>
            </div>
            <div class="col-lg-12">
                <div class="under-footer">
                    <p>Copyright © 2021 THPT Gia Vien B

                        <br>Design: <a href="#" target="_parent" title="free css templates">HienDS</a>
                    </p>
                    <ul>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-behance"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>


<!-- jQuery -->
<script src="{{asset("assets/js/jquery-2.1.0.min.js")}}"></script>

<!-- Bootstrap -->
<script src="{{asset("assets/js/popper.js")}}"></script>
<script src="{{asset("assets/js/bootstrap.min.js")}}"></script>

<!-- Plugins -->
<script src="{{asset("assets/js/owl-carousel.js")}}"></script>
<script src="{{asset("assets/js/accordions.js")}}"></script>
<script src="{{asset("assets/js/datepicker.js")}}"></script>
<script src="{{asset("assets/js/scrollreveal.min.js")}}"></script>
<script src="{{asset("assets/js/jquery.counterup.min.js")}}"></script>
<script src="{{asset("assets/js/imgfix.min.js")}}"></script>
<script src="{{asset("assets/js/slick.js")}}"></script>
<script src="{{asset("assets/js/lightbox.js")}}"></script>
<script src="{{asset("assets/js/isotope.js")}}"></script>

<!-- Global Init -->
<script src="{{asset("assets/js/custom.js")}}"></script>

<script>

    $(function () {
        var selectedClass = "";
        $("p").click(function () {
            selectedClass = $(this).attr("data-rel");
            $("#portfolio").fadeTo(50, 0.1);
            $("#portfolio div").not("." + selectedClass).fadeOut();
            setTimeout(function () {
                $("." + selectedClass).fadeIn();
                $("#portfolio").fadeTo(50, 1);
            }, 500);

        });
    });

</script>

</body>

</html>
