@extends("layout.client")
@section("banner")
    @if (session('success'))
        <script>
            new AWN().success('{{session('success')}}')
        </script>
    @endif
    <div class="page-heading" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content">
                        <h2>Xác minh học sinh GVB</h2>
                        <span>Nếu phát hiện tài khoản gian lận sẽ bị xóa ngay lập tức !</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section("content")
    <div class="verification container">
        <form action="{{route("user.verification.store")}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="id_card">Số CMND hoặc mã thẻ HS</label>
                <input type="text" class="form-control" name="id_card" id="id_card" required>
            </div>
            <div class="form-group">
                <label for="input">Tải ảnh CMND hoặc thẻ học sinh tại đây </label>
                <input type="file" class="form-control-file" id="input">
            </div>
            <canvas id="canvas" width="0" height="0"></canvas>
            <input id="file_output" name="card_image" type="hidden">
            <div class="form-group">
                <label for="grade">Lớp</label>
                <input type="text" maxlength="3" name="grade" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Xác minh ngay</button>
        </form>
    </div>
    <script>
        var canvas = document.getElementById("canvas");
        var ctx = canvas.getContext("2d");
        var cw = canvas.width;
        var ch = canvas.height;
        var maxW = 800;
        var maxH = 400;

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
