@extends("layout.client")
@section("banner")
    @if (session('success'))
        <script>
            new AWN().success('{{session('success')}}')
        </script>
    @endif
    @if (session('out-of-coin'))
        <script>
            new AWN().warning('{{session('out-of-coin')}}')
        </script>
    @endif
    <div class="page-heading about-page-heading" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content">
                        <h2>Giỏ sách của bạn</h2>
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section("content")
    <div class="container pb-5 mt-n2 mt-md-n3">
        <div class="row">
            <div class="col-xl-9 col-md-8">
                <h2 class="h6 d-flex flex-wrap justify-content-between align-items-center px-4 py-3 bg-secondary">
                    <div class="text-success">Có {{$acceptItems->count()}} ấn phẩm đã chấp nhận cho bạn thuê,</div>
                    <a href="#" data-toggle="modal" data-target="#ban">
                        <div class="text-danger">{{$banItems->count()}} ấn phẩm bị từ chối,</div>
                    </a>
                    <div class="text-warning">{{$waitItems->count()}} ấn phẩm đang chờ</div>
                    <a class="font-size-sm" href="{{route("index")}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-chevron-left" style="width: 1rem; height: 1rem;">
                            <polyline points="15 18 9 12 15 6"></polyline>
                        </svg>
                        Về trang chủ</a></h2>
                <!-- Item-->
                @php
                    $total=0;
                @endphp
                @if($acceptItems->count()>0)
                    @foreach($acceptItems as $item)
                        <div class="d-sm-flex justify-content-between my-4 pb-4 border-bottom">
                            <div class="media d-block d-sm-flex text-center text-sm-left">
                                <a class="cart-item-thumb mx-auto mr-sm-4" href="#"><img
                                        src="{{$item->Product()->first()->main_thumbnail}}" alt="Product"></a>
                                <div class="media-body pt-3">
                                    <h3 class="product-card-title font-weight-semibold border-0 pb-0"><a
                                            href="#">{{$item->Product()->first()->name}}</a></h3>
                                    <div class="font-size-sm"><span class="text-muted mr-2">Chủ sở hữu</span>Amdin GVB
                                        Book
                                    </div>
                                    <div
                                        class="font-size-lg text-primary pt-2">{{($item->Product()->first()->price!=null)?number_format($item->Product()->first()->price)." đ":"Miễn phí (Áp dụng HS GVB)"}}</div>
                                    @php
                                        $date = new DateTime($item->expiry);
                                        $total += $item->Product()->first()->price;
                                    @endphp
                                    <div class="font-size-lg pt-2">Hạn thuê cho phép:<span
                                            class="text-success">{{$date->format('d-m-Y')}}</span></div>
                                </div>
                            </div>
                            <div class="pt-2 pt-sm-0 pl-sm-3 mx-auto mx-sm-0 text-center text-sm-left"
                                 style="max-width: 10rem;">
                                <button class="btn btn-outline-danger btn-sm btn-block mb-2" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-trash-2 mr-1">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path
                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                    </svg>
                                    Gỡ khỏi giỏ
                                </button>
                            </div>
                        </div>
                @endforeach
            @endif
            <!-- Item-->
            </div>
            <!-- Sidebar-->
            <div class="col-xl-3 col-md-4 pt-3 pt-md-0">
                <h2 class="h6 px-4 py-3 bg-secondary text-center">
                    Tổng
                </h2>
                <div class="h3 font-weight-semibold text-center py-3">{{number_format($total)}} đ</div>
                <hr>
                <a class="btn btn-outline-secondary btn-block" href="#" data-toggle="modal" data-target="#order">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-credit-card mr-2">
                        <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                        <line x1="1" y1="10" x2="23" y2="10"></line>
                    </svg>
                    Thuê ngay</a>
            </div>
        </div>
    </div>
    <style>
        body {
            margin-top: 20px;
        }

        .cart-item-thumb {
            display: block;
            width: 10rem
        }

        .cart-item-thumb > img {
            display: block;
            width: 100%
        }

        .product-card-title > a {
            color: #222;
        }

        .font-weight-semibold {
            font-weight: 600 !important;
        }

        .product-card-title {
            display: block;
            margin-bottom: .75rem;
            padding-bottom: .875rem;
            border-bottom: 1px dashed #e2e2e2;
            font-size: 1rem;
            font-weight: normal;
        }

        .text-muted {
            color: #888 !important;
        }

        .bg-secondary {
            background-color: #f7f7f7 !important;
        }

        .accordion .accordion-heading {
            margin-bottom: 0;
            font-size: 1rem;
            font-weight: bold;
        }

        .font-weight-semibold {
            font-weight: 600 !important;
        }
    </style>
    <!-- Ban list -->
    <div class="modal fade" id="ban" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Danh sách bị từ chối</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                @if(isset($banItems))
                    @foreach($banItems as $item)
                        <div class="modal-body">
                            <a href="{{route("product",$item->Product()->first()->slug)}}">
                                <div class="row">
                                    <div class="col-md-3 col-12">
                                        <img src="{{$item->Product()->first()->main_thumbnail}}" class="w-100"/>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="text-danger h5">{{$item->Product()->first()->name}}</div>
                                        <div class="text-dark">Chủ sở hữu: {{$item->Owner()->first()->name}}</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="order" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Xác nhận đơn thuê</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route("order.store")}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Địa chỉ</label>
                            <input type="text" class="form-control" id="exampleInputEmail1"
                                   value="{{isset(backpack_user()->address)?backpack_user()->address:""}}"
                                   placeholder="có thể nhập tên lớp hoặc địa chỉ nhà"
                                   name="address"
                                   required
                            >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số điện thoại</label>
                            <input type="text" class="form-control" id="exampleInputEmail1"
                                   placeholder="Số điện thoại"
                                   value="{{isset(backpack_user()->phone)?backpack_user()->phone:""}}"
                                   name="phone"
                                   required
                            >
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Phương thức thanh toán</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="payment_method">
                                <option value="coin">Xu GVB (Hiện có {{number_format(backpack_user()->coin)}}đ)
                                </option>
                                <option value="cash">Chuyển tiền trực tiếp</option>
                                <option value="momo" disabled>Chuyển tiền qua Momo (Đang nâng cấp)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Ghi chú thêm</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="5"
                                      name="note"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Xác nhân</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
@endsection
