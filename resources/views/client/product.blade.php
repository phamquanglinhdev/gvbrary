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
                        <div>
                            Người đăng : <a
                                href="{{route("user.profile",$product->Published->email)}}">{{$product->Published()->first()->name}}</a>
                        </div>
                        <div>
                            Ngày đăng: {{$product->updated_at}}
                        </div>
                        <div>
                            Ngày đăng: {{$product->Tags()->get()}}
                        </div>
                        <div>
                            <ul style="display: flex">
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                            </ul>
                        </div>
                        <span
                            class="price">{{isset($product->price)?number_format($product->price)." đ":"Miễn phí"}}</span>
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
                                <h4>Thuê: {{isset($product->price)?number_format($product->price)." đ":"Miễn phí"}}</h4>
                                <br>
                                @if(!isset($product->price) && backpack_user()->role>2)
                                    <br>
                                    <div class="text-danger d-block">*Ấn phẩm miễn phí áp dụng cho thành viên trường
                                        THPT GVB
                                    </div>
                                    <div class="main-border-button d-block w-100"><a
                                            href="{{route("user.verification")}}">Xác minh thành viên</a></div>
                                @else
                                    <div class="main-border-button d-block w-100"><a href="#" data-toggle="modal"
                                                                                     data-target="#addRequest">Thêm vào
                                            giỏ sách</a></div>
                                @endif

                            </div>
                        @else
                            <br>
                            <div class="text-danger d-block">*Đăng nhập đế thuê / mượn.</div>
                            <a class="text-white" href="{{route("backpack.auth.login")}}">
                                <div class="btn btn-outline-secondary d-block w-100">Đăng nhập</div>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="addRequest" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{$product->name}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Người đăng :
                    <a class="text-success"
                       href="{{route("user.profile",$product->Published()->first()->email)}}">
                        {{$product->Published()->first()->name}}
                    </a>
                    Giá thuê : {{number_format($product->price)}} đ
                    <form method="POST" action="{{route("request.make")}}">
                        @csrf
                        <input type="hidden" name="slug" value="{{$product->slug}}"/>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hạn mượn mong muốn</label>
                            <input type="date" class="form-control" name="expiry" id="exampleInputPassword1"
                                   required>
                            <small class="text-muted">Định dạng quốc tế : Tháng - Ngày -Năm</small>
                        </div>
                        <button class="btn btn-success">Gửi yêu cầu</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Product Area Ends ***** -->
    <hr>
    <div class="container d-flex justify-content-center mt-100 mb-100">
        <div class="row w-100">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Đánh giá mới nhất</h4>
                        <h6 class="card-subtitle">Đánh giá của người dùng về sách này </h6>
                    </div>
                    @php
                        $commentRole = ["Quản trị viên","Bà chủ cho thuê sách","Học sinh GVB","Dân thường"]
                    @endphp
                    @if($product->Comment()->get() !== null)
                        @foreach($product->Comment()->get() as $comment)
                            @if($comment->status==1)
                                <a href="{{route("user.profile","phamquanglinh.dev@gmail.com")}}">
                                    <div class="comment-widgets m-b-20">
                                        <div class="d-flex flex-row comment-row">
                                            <div class="p-2 mr-2"><span class="round"><img
                                                        src="https://www.gravatar.com/avatar/{{md5($comment->User()->first()->email)}}?s=1000"
                                                        alt="user"
                                                        width="60"></span></div>
                                            <div class="comment-text w-100">
                                                <h5><a class="text-dark"
                                                       href="{{route("user.profile",$comment->User()->first()->email)}}">{{$comment->User()->first()->name}}
                                                        </a></h5>
                                                <div class="comment-footer"><span
                                                        class="date">{{$comment->updated_at}}</span> <span
                                                        class="label label-info">{{$commentRole[$comment->User()->first()->role]}}</span>
                                                    <span class="action-icons">
                                        <a href="#" data-abc="true"><i class="fa fa-trash"></i></a>
                                    </span>
                                                </div>
                                                <p class="m-b-5 m-t-10">
                                                    {{$comment->comment}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    <hr>
    @if(backpack_auth()->check())
        <div class="container">
            <form action="{{route("comment.store")}}" method="POST">
                @csrf
                <div class="rating-css">
                    <div class="star-icon">
                        <input type="radio" name="rating" value="1" id="rating1" required>
                        <label for="rating1" class="fa fa-star"></label>
                        <input type="radio" name="rating" value="2" id="rating2" required>
                        <label for="rating2" class="fa fa-star"></label>
                        <input type="radio" name="rating" value="3" id="rating3" required>
                        <label for="rating3" class="fa fa-star"></label>
                        <input type="radio" name="rating" value="4" id="rating4" required>
                        <label for="rating4" class="fa fa-star"></label>
                        <input type="radio" name="rating" value="5" id="rating5" checked required>
                        <label for="rating5" class="fa fa-star"></label>
                    </div>
                </div>
                <div class="form-group">
                <textarea name="comment" class="form-control" placeholder="Nhập đánh giá của bạn tại đây..." rows="4"
                          required></textarea>
                </div>
                <input type="hidden" name="product_id" value="{{$product->id}}">
                <button class="btn btn-outline-secondary">Đánh giá</button>
            </form>
        </div>
    @else
        <div class="text-center text-danger">Đăng nhập để đánh giá ngay </div>
    @endif
    <style>
        .rating-css div {
            color: #ffe400;
            font-family: sans-serif;
            font-weight: 800;
            text-transform: uppercase;
            padding: 20px 0;
        }

        .rating-css input {
            display: none;
        }

        .rating-css input + label {
            text-shadow: 1px 1px 0 #ffe400;
            cursor: pointer;
            font-size: 30px;
        }

        .rating-css input:checked + label ~ label {
            color: #838383;
        }

        .rating-css label:active {
            transform: scale(0.8);
            transition: 0.3s ease;
        }

        /*    */
        .card-no-border .card {
            border: 0px;
            border-radius: 4px;
            -webkit-box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.05);
            box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.05)
        }

        .card-body {
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            padding: 1.25rem
        }

        .comment-widgets .comment-row:hover {
            background: rgba(0, 0, 0, 0.02);
            cursor: pointer
        }

        .comment-widgets .comment-row {
            border-bottom: 1px solid rgba(120, 130, 140, 0.13);
            padding: 15px
        }

        .comment-text:hover {
            visibility: hidden
        }

        .comment-text:hover {
            visibility: visible
        }

        .label {
            padding: 3px 10px;
            line-height: 13px;
            color: #ffffff;
            font-weight: 400;
            border-radius: 4px;
            font-size: 75%
        }

        .round img {
            border-radius: 100%
        }

        .label-info {
            background-color: #1976d2
        }

        .label-success {
            background-color: green
        }

        .label-danger {
            background-color: #ef5350
        }

        .action-icons a {
            padding-left: 7px;
            vertical-align: middle;
            color: #99abb4
        }

        .action-icons a:hover {
            color: #1976d2
        }

        .mt-100 {
            margin-top: 100px
        }

        .mb-100 {
            margin-bottom: 100px
        }
    </style>
@endsection
