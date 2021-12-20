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
            <hr>
            <div class="row justify-content-center align-items-center">
                @php
                    $categories = \App\Models\Category::get();
                    $tags = \App\Models\Tag::get();
                @endphp
                <div class="col-md-6 col-12">
                    <div class="dropdown w-100">
                        <button class=" w-100 btn btn-secondary dropdown-toggle" type="button" id="categories"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Danh mục
                        </button>
                        <div class="dropdown-menu w-100" aria-labelledby="categories">
                            @if(isset($categories))
                                @foreach($categories as $category)
                                    <a class="dropdown-item" href="{{route("products",$category->slug)}}">{{$category->name}}</a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="dropdown w-100">
                        <button class="btn btn-secondary dropdown-toggle w-100" type="button" id="tags"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Thể loại
                        </button>
                        <div class="dropdown-menu w-100" aria-labelledby="tags">
                            @if(isset($tags))
                                @foreach($tags as $tag)
                                    <a class="dropdown-item" href="{{route("tags",$tag->slug)}}">{{$tag->name}}</a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                @if($products->first()!=null)
                    @foreach($products as $key => $product)
                        @if($key>=(($page-1)*12) && $key < $page*12)
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
                @else
                    <div class="p-5 h1 w-100 text-center">Hiện chưa có ấn phẩm nào được cập nhật tại đây</div>
                @endif
                <div class="col-lg-12">
                    <div class="pagination">
                        @if(!isset($method))
                            <ul>
                                @if(isset($count))
                                    @for($i=1;$i<=$count+1;$i++)
                                        @if($i==$page)
                                            <li class="active">
                                                <a href="{{route("products",$category->slug."/$i")}}">{{$i}}</a>
                                            </li>
                                        @else
                                            <li>
                                                <a href="{{route("products",$category->slug."/$i")}}">{{$i}}</a>
                                            </li>
                                        @endif
                                    @endfor
                                @endif
                            </ul>
                        @else
                            <ul>
                                @if(isset($count))
                                    @for($i=1;$i<=$count+1;$i++)
                                        @if($i==$page)
                                            <li class="active">
                                                <a href="{{route("tags",$category->slug."/$i")}}">{{$i}}</a>
                                            </li>
                                        @else
                                            <li>
                                                <a href="{{route("tags",$category->slug."/$i")}}">{{$i}}</a>
                                            </li>
                                        @endif
                                    @endfor
                                @endif
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Products Area Ends ***** -->
@endsection
