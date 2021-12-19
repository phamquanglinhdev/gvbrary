@extends(backpack_view('blank'))
@section("content")
    <!-- ***** Product Area Starts ***** -->
    <section class="section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-images">
                        <img src="{{$product->first_thumbnail}}" alt="" class="w-100">
                        <img src="{{$product->second_thumbnail}}" alt="" class="w-100">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-content">
                        <h4>{{$product->name}}</h4>
                        <div>
                            Người đăng : <a
                                href="{{route("user.profile",$product->Published->email)}}">{{$product->Published()->first()->name}}</a>
                        </div>
                        <div>
                            Ngày đăng: {{$product->updated_at}}
                        </div>
                        <div class="bg-white p-2">{!! $product->description !!}</div>
                        <h4>Thuê: {{isset($product->price)?number_format($product->price)." đ":"Miễn phí"}}</h4>
                        <a href="{{route("draft")}}" class="btn btn-primary text-white">Quay lại</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Product Area Ends ***** -->
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
