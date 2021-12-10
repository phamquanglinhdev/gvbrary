<div class="h5">
    Danh sách ấn phẩm trong đơn
</div>
@php
    $total = 0;
@endphp
@if(isset($items))
    @foreach($items as $item)
        @php
            $total+= $item->Product()->first()->price;
        @endphp
        <div>
            <span class="text-primary">Ấn phẩm: </span> {{$item->Product()->first()->name}} |
            <span class="text-primary">Chủ sở hữu</span>: {{$item->Owner()->first()->name}} |
            <span class="text-primary">{{number_format($item->Product()->first()->price)}} đ</span>
        </div>
    @endforeach
    <div class="text-danger">Tổng thanh toán : {{number_format($total)}} đ</div>
@endif
