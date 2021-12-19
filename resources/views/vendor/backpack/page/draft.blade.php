@extends(backpack_view('blank'))
@section('content')
    @if(session("success"))
        @php \Prologue\Alerts\Facades\Alert::success("Duyệt thành công") @endphp
    @endif
    @if(session("danger"))
        @php \Prologue\Alerts\Facades\Alert::error("Xóa thành công") @endphp
    @endif
    <div class="container">
        <h2>Ấn phẩm chờ duyệt </h2>
        <hr>
    </div>
    <div class="container">
        <div class="row">
            @if(isset($products))
                @foreach($products as $product)
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="{{$product->main_thumbnail}}" alt="Card image cap">
                            <div class="card-body">
                                <dic class="font-weight-bold">{{$product->name}}</dic>
                                <div class="card-text">Giá thuê :{{number_format($product->price)}} đ</div>
                                <div class="card-text mb-3">Người đăng :{{$product->Published()->first()->name}}</div>
                                <a href="{{route("show-draft",$product->slug)}}" class="btn btn-primary">Chi tiết</a>
                                <a href="{{route("accept-draft",$product->id)}}" class="btn btn-success">Đồng ý</a>
                                <a href="{{route("deny-draft",$product->id)}}" class="btn btn-danger">Từ chối</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
