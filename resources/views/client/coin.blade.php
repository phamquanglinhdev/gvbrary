@extends("layout.client")
@section("banner")
    <div class="page-heading about-page-heading" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content">
                        <h2>Nạp GVB Coin</h2>
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
            <div class="col-md-3">
                <div class="img-fluid">
                    <img class="w-100 rounded-circle"
                         src="https://www.gravatar.com/avatar/{{md5(backpack_user()->email)}}?s=1000" alt="avatar"/>
                </div>
                <div class="mt-3 text-center">
                    <div class="h4"> {{backpack_user()->name}}</div>
                    <div class="font-italic"> {{backpack_user()->email}}</div>
                </div>
                <div class="mt-lg-5 bg-warning p-5 text-center rounded">
                    <div class="pb-1">
                        <i class="fas fa-credit-card text-white h1"></i>
                    </div>
                    <div class="h4 text-white"> {{number_format(backpack_user()->coin)}} đ</div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-6">
                        <div class="wrapper bg-light p-3">
                            <div class="h4">Thông tin thanh toán qua <span
                                    class="font-weight-bold text-primary">ATM</span></div>
                            <hr>
                            <div>Số tài khoản : <span class="font-weight-bold">48310000691176</span></div>
                            <div>Tên tài khoản : <span class="font-weight-bold">PHAM QUANG LINH</span></div>
                            <div> Ngân Hàng : <span class="font-weight-bold">BIDV</span></div>
                            <div>Chi nhánh : <span class="font-weight-bold">Ninh Bình</span></div>
                            <div>Nội dung chuyển khoản : <span
                                    class="font-weight-bold text-success">GVBCOIN {{backpack_user()->id}}</span></div>
                            <hr>
                            <div class="text-danger">
                                *Lưu ý : Chuyển sai nội dung sẽ mất toàn bộ số tiền nạp <br>
                                *Sau khi chuyển vui lòng điền form bên dưới và gửi đi nếu không coin sẽ không được thêm
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="wrapper bg-light p-3">
                            <style>
                                .text-pink {
                                    color: #a91f6c !important;
                                }
                            </style>
                            <div class="h4">Thông tin thanh toán <span class="font-weight-bold text-pink">MOMO</span>
                            </div>
                            <hr>
                            <div>Số điện thoại : <span class="font-weight-bold">0904.800.240</span></div>
                            <div>Tên tài khoản : <span class="font-weight-bold">Phạm Quang Linh</span></div>
                            <div>Nội dung chuyển khoản : <span
                                    class="font-weight-bold text-pink">GVBCOIN {{backpack_user()->id}}</span></div>
                            <br>
                            <br>
                            <hr>
                            <div class="text-danger">
                                *Lưu ý : Chuyển sai nội dung sẽ mất toàn bộ số tiền nạp <br>
                                *Sau khi chuyển vui lòng điền form bên dưới và gửi đi nếu không coin sẽ không được thêm
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-lg-5">
                    <form action="{{route("purchase.store")}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <select class="form-control" name="methods" id="exampleFormControlSelect1" required>
                                        <option selected disabled value="">Phương thức nạp</option>
                                        <option value="atm">ATM</option>
                                        <option value="momo">MOMO</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" id="exampleInputEmail1"
                                           aria-describedby="emailHelp" name="value" type="number" placeholder="Số tiền" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Gửi</button>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="input">Chụp hóa đơn và gửi vào đây</label>
                                    <br>
                                    <img id="blank_img" src="https://i.pinimg.com/originals/76/31/02/763102ba6fca3fce92caa95598d6082b.png" class="w-100 d-none">
                                    <canvas id="canvas" width="100" height="100">

                                    </canvas>
                                    <input id="file_output" name="bill" type="hidden">
                                    <input type="file" class="form-control-file" id="input" required>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>

        var canvas = document.getElementById("canvas");
        var ctx = canvas.getContext("2d");
        var blanka =  document.getElementById("blank_img");
        ctx.drawImage(blanka,0,0,100,100)
        var cw = canvas.width;
        var ch = canvas.height;
        var maxW = 100;
        var maxH = 100;

        var input = document.getElementById('input');
        var output = document.getElementById('file_output');
        input.addEventListener('change', handleFiles);

        function handleFiles(e) {
            var img = new Image;
            img.onload = function () {
                var iw = img.width;
                var ih = img.height;
                var scale = Math.min((maxW / iw), (maxH / ih));
                var iwScaled = iw * scale;
                var ihScaled = ih * scale;
                canvas.width = iwScaled;
                canvas.height = ihScaled;
                ctx.drawImage(img, 0, 0, iwScaled, ihScaled);
                output.value = canvas.toDataURL("image/jpeg", 0.5);
            }
            img.src = URL.createObjectURL(e.target.files[0]);
        }
    </script>
@endsection
