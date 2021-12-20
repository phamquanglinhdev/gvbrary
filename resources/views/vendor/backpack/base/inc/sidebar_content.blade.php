<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->

@if(backpack_user()->role==1 or backpack_user()->role==0)
    <li class="nav-title">Chức năng quản trị</li>
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i>Bảng điều khiển</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('category') }}'><i class='nav-icon la la-book-medical'></i> Danh mục</a></li>

    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('review') }}'><i class='nav-icon las la-image'></i> Review Sách</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('order') }}'><i class='nav-icon las la-box'></i> Đơn hàng</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('notification') }}'><i class='nav-icon las la-bell'></i> Thông báo</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('verification') }}'><i class='nav-icon la la-user-check'></i> Đang chờ xác minh</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('history') }}'><i class='nav-icon la la-history'></i> Lịch sử mượn sách (All)</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('comment') }}'><i class='nav-icon la la-comment'></i> Bình luận đang chờ</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('post') }}'><i class='nav-icon la la-pinterest'></i>Tin tức/Bài viết</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ route('draft') }}'><i class='nav-icon la la-warning'></i>Ấn phẩm chờ duyệt</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('coin') }}'><i class='nav-icon la la-coins'></i>Coin tích lũy</a></li>
@endif
<li class="nav-title">Chức năng dành cho cá nhân </li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('product') }}'><i class='nav-icon  la la-book'></i> Ấn
        phẩm</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('request') }}'><i class='nav-icon las la-money-check'></i>
        Yêu cầu mượn sách</a></li>
@if(backpack_user()->role==9)
    <li class="nav-title">Chức năng dành cho tổ chức </li>
    <li class="nav-title">(Chưa xác minh)</li>
    <li class='nav-item'><a class='nav-link' href='{{route("xupload")}}'><i class='nav-icon las la-user-check'></i>Xác minh tổ chức</a></li>
    <li class='nav-item disabled'><a class='nav-link text-muted'><i class='nav-icon las la-file-excel'></i><del>Nhập hàng loạt</del></a></li>
@endif
@if(backpack_user()->role==8)
    <li class="nav-title">Chức năng dành cho tổ chức </li>
    <li class='nav-item'><a class='nav-link' href='{{route("xupload")}}'><i class='nav-icon las la-file-excel'></i>Nhập hàng loạt</a></li>
@endif




<li class='nav-item'><a class='nav-link' href='{{ backpack_url('tag') }}'><i class='nav-icon la la-question'></i> Tags</a></li>
