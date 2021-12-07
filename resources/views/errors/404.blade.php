@extends('layout.client')
@section("banner")
    <!-- ***** Main Banner Area Start ***** -->
    <div class="page-heading about-page-heading" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content">
                        <h2>404 NOT FOUND !!</h2>
                        <span>Có vẻ như bạn vào trang không đúng rồi, vào lại đi nào !!!</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->
@endsection
@section("content")
    <h1 class="text-center pt-5">Có thể bạn quan tâm !!</h1>
    <div class="main-banner">
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
                                                <p>Lorem ipsum dolor sit amet, conservisii ctetur adipiscing elit incid.</p>
                                                <div class="main-border-button">
                                                    <a href="#">Xem ngay</a>
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
                                                    <a href="#">Xem ngay</a>
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
                                                    <a href="#">Xem ngay</a>
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
                                                <p>Lorem ipsum dolor sit amet, conservisii ctetur adipiscing elit incid.</p>
                                                <div class="main-border-button">
                                                    <a href="#">Xem ngay</a>
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
@endsection
