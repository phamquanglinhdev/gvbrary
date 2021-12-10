@extends("layout.client")
@section("banner")
    @php($title="Thông báo")
    <!-- ***** Main Banner Area Start ***** -->
    <div class="page-heading about-page-heading" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content">
                        <h2>Thông báo</h2>
                        <span>Xem tất cả log thông báo tại đây !</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->
@endsection
@section("content")
    <div class="container scrolls">
        <div class="list-group">
            @if(isset($notifications))
                @foreach($notifications as $notification)
                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{$notification->title}}</h5>
                            <small class="text-muted">{{$notification->updated_at}}</small>
                        </div>
                        <p class="mb-1">{{$notification->message}}</p>
                    </a>
                @endforeach
            @endif
        </div>
    </div>
    <style>
        .scrolls{overflow-y: scroll;max-height: 50vh}
    </style>
@endsection
