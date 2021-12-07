@extends("layout.client")
@section("banner")
    <!-- ***** Main Banner Area Start ***** -->
    <div class="page-heading" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content">
                        <h2>{{$category->name}}</h2>
                        <span>Các ẩn phầm từ : {{$category->name}} </span>
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
                        <h2>{{$category->name}}</h2>
                        <span>Có thể thuê hoặc mượn</span>
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
                                                <li><a href="single-product.html"><i class="fa fa-eye"></i></a></li>
                                                <li><a href="single-product.html"><i class="fa fa-star"></i></a></li>
                                                <li><a href="single-product.html"><i class="fa fa-shopping-cart"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <a href="#"><img src="{{$product->main_thumbnail}}" alt=""></a>
                                    </div>
                                    <a href="#">
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
                @else
                    <div class="p-5 h1 w-100 text-center">Hiện chưa có ấn phẩm nào được cập nhật tại đây</div>
                @endif
                <div class="col-lg-12">
                    <div class="pagination">
                        <ul>
                            <li class="active">
                                <a href="#">1</a>
                            </li>
                            <li>
                                <a href="#">2</a>
                            </li>
                            <li>
                                <a href="#">3</a>
                            </li>
                            <li>
                                <a href="#">4</a>
                            </li>
                            <li>
                                <a href="#">></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Products Area Ends ***** -->
@endsection
