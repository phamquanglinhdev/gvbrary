@extends("layout.client")
@section("banner")
    <!-- ***** Main Banner Area Start ***** -->
    <div class="page-heading" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content">
                        <h2>Kết quả tìm kiếm</h2>
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->
@endsection
@section("content")
    <section class="section" id="products">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        {{--                        <h2>{{$category->name}}</h2>--}}
                        <h2>Sản phẩm</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                @if($products->first()!=null)
                    @foreach($products as $product)
                        @if($product->status==0)
                            <div class="col-lg-4">
                                <div class="item">
                                    <div class="thumb">
                                        <div class="hover-content">
                                            <ul>
                                                <li><a href="{{route("product",$product->slug)}}"><i
                                                            class="fa fa-eye"></i></a></li>
                                                <li><a href="{{route("product",$product->slug)}}"><i
                                                            class="fa fa-star"></i></a></li>
                                                <li><a href="{{route("product",$product->slug)}}"><i
                                                            class="fa fa-shopping-cart"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <a href="{{route("product",$product->slug)}}"><img
                                                src="{{$product->main_thumbnail}}" alt=""></a>
                                    </div>
                                    <a href="{{route("product",$product->slug)}}">
                                        <div class="down-content p-2">
                                            <h4>{{$product->name}}</h4>
                                            @if($product->price!=null)
                                                <span>{{number_format($product->price)}} đ</span>
                                            @else
                                                <span>Mượn miễn phí</span>
                                            @endif
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
                {{--                <div class="col-lg-12">--}}
                {{--                    <div class="pagination">--}}
                {{--                        <ul>--}}
                {{--                            <li class="active">--}}
                {{--                                <a href="#">1</a>--}}
                {{--                            </li>--}}
                {{--                            <li>--}}
                {{--                                <a href="#">2</a>--}}
                {{--                            </li>--}}
                {{--                            <li>--}}
                {{--                                <a href="#">3</a>--}}
                {{--                            </li>--}}
                {{--                            <li>--}}
                {{--                                <a href="#">4</a>--}}
                {{--                            </li>--}}
                {{--                            <li>--}}
                {{--                                <a href="#">></a>--}}
                {{--                            </li>--}}
                {{--                        </ul>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
        </div>
    </section>
    <hr>
    @if(isset($categories))
        <section class="section" id="categories">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-heading text-center">
                            <h2>Danh mục </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container pt-4 ">
                <ul class="list-group">
                    @foreach($categories as $category)
                        <a href="{{route("products",$category->slug)}}">
                        <li class="list-group-item d-flex justify-content-between align-items-center">

                                <span class="text-dark">{{$category->name}}</span>
                                <span class="badge badge-primary badge-pill p-2">Ấn phẩm : {{$category->Products()->count()}}</span>

                        </li>
                        </a>
                        <hr>
                    @endforeach
                </ul>
            </div>
        </section>
    @endif
    <hr>
    @if(isset($tags))
        <section class="section" id="categories">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-heading text-center">
                            <h2>Thể loại </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container pt-4 ">
                <ul class="list-group">
                    @foreach($tags as $category)
                        <a href="{{route("tags",$category->slug)}}">
                            <li class="list-group-item d-flex justify-content-between align-items-center">

                                <span class="text-dark">{{$category->name}}</span>
                                <span class="badge badge-primary badge-pill p-2">Ấn phẩm : {{$category->Products()->count()}}</span>

                            </li>
                        </a>
                        <hr>
                    @endforeach
                </ul>
            </div>
        </section>
    @endif
    <!-- ***** Products Area Ends ***** -->
@endsection
