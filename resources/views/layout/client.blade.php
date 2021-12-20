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
<!-- Messenger Plugin chat Code -->
<div id="fb-root"></div>

<!-- Your Plugin chat code -->
<div id="fb-customer-chat" class="fb-customerchat">
</div>

<script>
    var chatbox = document.getElementById('fb-customer-chat');
    chatbox.setAttribute("page_id", "102972452243999");
    chatbox.setAttribute("attribution", "biz_inbox");
</script>

<!-- Your SDK code -->
<script>
    window.fbAsyncInit = function () {
        FB.init({
            xfbml: true,
            version: 'v12.0'
        });
    };

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
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
                    <a href="{{route("index")}}" class="d-lg-block d-none logo col-md-2 col-12">
                        <img src="{{asset("assets/images/logo.png")}}" class="w-100">
                    </a>
                    <a href="{{route("index")}}" class="d-lg-none d-flex align-items-center logo col-md-2 col-12">
                        <img src="{{asset("assets/images/logo.png")}}" class="w-50">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav col-md-10 col-12">
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
                                <li><a href="{{route("product.index")}}">Cho thuê sách</a></li>
                                <li><a href="{{route("products",'sach-mien-phi.aspx')}}">Sách miễn phí <span
                                            class="badge badge-success">Available</span></a>
                                </li>
                                @if(backpack_auth()->check())
                                    @if(backpack_user()->role==3)
                                        <li><a href="{{route("user.verification")}}">Xác mình học sinh GVB</a></li>
                                    @endif
                                @endif
                            </ul>
                        </li>
                        @if(backpack_auth()->check())
                            <li class="submenu">
                                <a href="javascript:;"><i class="fas fa-user">
                                    </i> {{backpack_user()->name}}
                                    @if(backpack_user()->role==2)
                                        <span class="badge badge-warning">Member</span>
                                    @endif
                                    @if(backpack_user()->role==1)
                                        <span class="badge badge-primary">Publisher</span>
                                    @endif
                                    @if(backpack_user()->role==0)
                                        <span class="badge badge-success">Admin</span>
                                    @endif
                                </a>
                                <ul>
                                    <li><a href="{{route("user.profile")}}">Thông tin tài khoản</a></li>
                                    <li><a href="#">Lịch sử tìm kiếm</a></li>
                                    <li><a href="{{route("user.history")}}">Sách đã mượn (thuê)</a></li>
                                    <li><a href="{{route("purchase")}}">Nạp coin</a></li>
                                    <li><a href="#">Quản lý thanh toán</a></li>
                                    <li><a href="{{route("request.index")}}">Quản lý yêu cầu mượn sách</a></li>
                                    @if(backpack_user()->role==0 or backpack_user()->role==1)
                                        <li><a href="{{route("backpack.dashboard")}}">Quản trị</a></li>
                                    @endif
                                    <li><a href="{{route("product.index")}}">Quản lý tủ sách</a></li>
                                    <li><a href="{{route("backpack.auth.logout")}}">Đăng xuất</a></li>
                                </ul>
                            </li>
                            <li class=""><a href="#"><i
                                        class="fas fa-coins"></i> {{number_format(backpack_user()->coin)}} đ</a></li>
                            <li class="">
                                <a href="{{route("cart")}}"><i class="fas fa-cart-plus"></i>
                                    <div class="badge badge-danger">
                                        @php
                                            $count =  \App\Models\Request::where("user_id","=",backpack_user()->id);
                                            $count = $count->where("status","=",0);
                                            $count =  $count->where("order_id","=",null)->count();
                                        @endphp
                                        {{$count}}
                                    </div>
                                </a></li>
                            <li>
                                <a id="pop-notification" data-toggle="modal" data-target="#popNotification"><i
                                        class="fas fa-bell"></i>
                                    @php
                                        $notifications =  \App\Models\Notification::where("user_id","=",backpack_user()->id);
                                        $countNof =$notifications->where("status","=",0)->count();
                                    @endphp
                                    @if($countNof >0)
                                        <div id="count-notification" class="badge badge-danger">

                                            {{$countNof}}
                                        </div>
                                    @endif
                                </a>
                            </li>
                        @else
                            <li><a href="{{route("backpack.auth.login")}}">Đăng nhập</a></li>
                            <li><a href="{{route("backpack.auth.register")}}">Đăng ký</a></li>
                        @endif
                        <li>
                            <a id="pop-notification" data-toggle="modal" data-target="#search"><i
                                    class="fas fa-search"></i></a>
                        </li>
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
<!-- Modal -->
@if(backpack_auth()->check())
    <div class="modal fade" id="popNotification" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Thông báo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @php
                        $notifications =  \App\Models\Notification::where("user_id","=",backpack_user()->id)->orderBy("created_at","DESC")->limit(5)->get()
                    @endphp
                    @if(isset($notifications))
                        @foreach($notifications as $notification)
                            <div class="list-group">
                                <a href="#"
                                   class="list-group-item list-group-item-action flex-column align-items-start {{$notification->status==0?"bg-light":""}} ">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1 {{$notification->status==0?"font-weight-bold text-success":""}}">{{$notification->title}}</h5>
                                        <small>{{$notification->updated_at}}</small>
                                    </div>
                                    <p class="mb-1">{{$notification->message}}.</p>
                                </a>
                            </div>
                            <hr>
                        @endforeach
                    @endif
                </div>
                <div class="modal-footer">
                    <a type="button" href="{{route("user.notification")}}" class="w-100 text-center text-muted">Xem tất
                        cả</a>
                </div>
            </div>
        </div>
    </div>
@endif


<!-- Modal -->
<div class="modal fade w-100" id="search" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-transparent border-0">
            <form action="{{route("search")}}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="keyword"
                           placeholder="Tìm theo tên sách , từ khóa ,..."
                           aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ***** Footer Start ***** -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="first-item">
                    <div class="logo">
                        <img src="{{asset("assets/images/white-logo.png")}}" alt="hexashop ecommerce templatemo"
                             class="w-75">
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
                    <p>Copyright © GVBARY

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

    $("#pop-notification").click(function () {
        $.ajax({
            type: 'GET',
            url: '{{route("user.notification.read")}}',
            success: function (data) {
                $("#count-notification").hide();
            },
            error: function () {
            }
        });
    });

</script>

</body>

</html>
