@extends("layout.client")
@section("banner")
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
    <div class="container">
        <div class="row">
            @if(isset($histories))
                @foreach($histories as $history)
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="p-1 bg-light">
                            <div class="card border-0 p-2" style="width: 18rem;">
                                <img class="card-img-top" src="{{$history->Product()->first()->main_thumbnail}}" alt="Card image cap">
                                <div class="card-body">
                                    <div class="card-title font-weight-bold">{{$history->Product()->first()->name}}</div>
                                    @php
                                        $start = new DateTime($history->starte);
                                        $end = new DateTime($history->expiry);
                                    @endphp
                                    <p class="card-text">Ngày thuê : {{$start->format('d-m-Y')}}</p>
                                    <p class="card-text">Hạn thuê : {{$end->format('d-m-Y')}}</p>
                                    <p class="card-text">Trạng thái :
                                        <span class="{{$history->status==1?"text-success":"text-warning"}}">
                                            {{$history->status==1?"Đang thuê":"Đã trả"}}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
