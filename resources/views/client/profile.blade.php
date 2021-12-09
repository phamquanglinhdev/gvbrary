@extends("layout.client")
@section("banner")
    <link rel="stylesheet" href="{{asset("assets/css/profile.css")}}">
    <script src="{{asset("assets/js/jquery-2.1.0.min.js")}}"></script>
    <!-- ***** Main Banner Area Start ***** -->
    <div class="page-heading" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content">
                        <h2>Hồ sơ cá nhân</h2>
                        <span>Chỉnh sửa hồ sơ cá nhân, quản lý tài khoản tại đây</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->
@endsection
@section("content")
    <div class="container prolife">
        <div>
            <div class="row">
                <div class="left col-lg-4">
                    <div class="photo-left">
                        <img class="photo"
                             src="https://www.gravatar.com/avatar/{{md5($user->email)}}?s=1000"/>
                        {{--                        <div class="active"></div>--}}
                    </div>
                    <h4 class="name">{{$user->name}}</h4>
                    <p class="info">{{$user->phone}}</p>
                    <p class="info">{{$user->email}}</p>
                    <div class="stats row">
                        <div class="stat col-xs-4" style="padding-right: 50px;">
                            <p class="number-stat">{{number_format($user->coin)}} đ</p>
                            <p class="desc-stat">Số dư Gvbary</p>
                        </div>
                        <div class="stat col-xs-4">
                            <p class="number-stat">19</p>
                            <p class="desc-stat">Ấn phẩm</p>
                        </div>
                        <div class="stat col-xs-4" style="padding-left: 50px;">
                            <p class="number-stat">0</p>
                            <p class="desc-stat">Lần thuê truyện</p>
                        </div>
                    </div>
                    <p class="desc">Xin chào , tôi là {{$user->name}}, tôi đến từ {{$user->address}}</p>
                    <div class="social">
                        <i class="fa fa-facebook-square" aria-hidden="true"></i>
                        <i class="fa fa-twitter-square" aria-hidden="true"></i>
                        <i class="fa fa-pinterest-square" aria-hidden="true"></i>
                        <i class="fa fa-tumblr-square" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="right col-lg-8">
                    <ul class="nav">
                        <li class="products nav-current" id="product_btn">Ấn phẩm đã đăng</li>
                        @if($user->id == backpack_user()->id)
                            <li class="info" id="info_btn">Chỉnh sửa thông tin</li>
                            <li class="withdraw" id="withdraw_btn">Rút tiền</li>
                        @endif
                    </ul>
                    {{--                    <span class="follow">Follow</span>--}}
                    <div id="products" class="row gallery currents">
                        @if(isset($products))
                            @foreach($products as $product)
                                <div class="col-md-4">
                                    <a href="{{route("product",$product->slug)}}">
                                        <img
                                            src="{{$product->main_thumbnail}}"/>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div id="info" class="mt-4 d-none">
                        <div class="p-2">
                            <div class="bg-light p-2 pt-3">
                                <div class="h4">Thông tin cơ bản</div>
                                <form action="#" method="POST">
                                    @csrf
                                    <div class="row w-100">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Họ và tên</label>
                                                <input type="text" name="name" class="form-control"
                                                       value="{{$user->name}}" id="name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Địa chỉ email</label>
                                                <input type="text" name="email" class="form-control"
                                                       value="{{$user->email}}" id="email" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phone">Số điện thoại</label>
                                                <input type="text" name="phone" class="form-control"
                                                       value="{{$user->phone}}" id="phone" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Căn cước công dân</label>
                                                <input type="text" name="id_card" class="form-control"
                                                       value="{{$user->id_card}}" id="id_card" required>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-outline-secondary">Cập nhật thông tin</button>
                                </form>
                            </div>
                            <div class="bg-light p-2 pt-3 mt-5">
                                <div class="h4">Đổi mật khẩu</div>
                                <form action="#" method="POST">
                                    @csrf
                                    <div class="row w-100">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name">Mật khẩu hiện tại</label>
                                                <input type="text" name="current_password" class="form-control"
                                                       value="" id="name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name">Mật khẩu mới</label>
                                                <input type="text" name="new_password" class="form-control"
                                                       value="" id="name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name">Nhập lại khẩu mới</label>
                                                <input type="text" name="re_password" class="form-control"
                                                       value="" id="name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-outline-secondary">Đổi mật khẩu</button>
                                </form>
                            </div>
                            @if(backpack_user()->role<=2)
                                <div class="bg-light p-2 pt-3 mt-5">
                                    <div class="h4">Thông tin thanh toán ( Dùng để rút tiền)</div>
                                    <form action="#" method="POST">
                                        @csrf
                                        <div class="row w-100">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleFormControlSelect1">Phương thức thanh toán</label>
                                                    <select class="form-control" id="exampleFormControlSelect1" name="paymemt_method">
                                                        <option value="atm">ATM ( Min 500.000đ)</option>
                                                        <option value="momo">MOMO (Min 10.000đ)</option>
                                                        <option value="cash">Tiền mặt (Min 100.000đ)</option>
                                                        <option disabled>Tiền mặt chỉ áp dụng cho Thành viên GVB</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">Thông tin thanh toán</label>
                                                    <input type="text" name="email" class="form-control" value="{{$user->email}}" id="email" required>

                                                </div>
                                            </div>
                                            <small class="text-muted col-md-12">ATM ( Số tài khoản + Tên + Tên ngân hàng), MOMO(Số MOMO + Tên), Tiền mặt ( Tên lớp)</small>
                                        </div>
                                        <button type="submit" class="btn btn-outline-secondary">Cập nhật thông tin</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div id="withdraw" class="row gallery d-none">
                        <div class="col-md-4">
                            Rút
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $("#info_btn").click(function () {
            $(".currents").addClass("d-none");
            $(".currents").removeClass("currents");
            $(".nav-current").removeClass("nav-current")
            $("#info_btn").addClass("nav-current");
            $("#info").addClass("currents");
            $("#info").removeClass("d-none");

        });
        $("#product_btn").click(function () {
            $(".currents").addClass("d-none");
            $(".currents").removeClass("currents");
            $(".nav-current").removeClass("nav-current")
            $("#product_btn").addClass("nav-current");
            $("#products").addClass("currents");
            $("#products").removeClass("d-none");

        });
        $("#withdraw_btn").click(function () {
            $(".currents").addClass("d-none");
            $(".currents").removeClass("currents");
            $(".nav-current").removeClass("nav-current")
            $("#withdraw_btn").addClass("nav-current");
            $("#withdraw").addClass("currents");
            $("#withdraw").removeClass("d-none");

        });
    </script>
@endsection
