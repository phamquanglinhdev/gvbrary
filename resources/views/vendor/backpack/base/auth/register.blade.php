@extends(backpack_view('layouts.plain'))

@section('content')
    <div class="img-fluid d-lg-block d-none w-50 m-auto">
        <img src="{{asset("assets/images/logo.png")}}" class="text-center w-100">
    </div>
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-4">
            <h3 class="text-center mb-4">
                <div class="img-fluid d-lg-none d-block">
                    <img src="{{asset("assets/images/logo.png")}}" class="text-center w-100">
                </div>
            </h3>
            <div class="card">
                <div class="card-body">
                    <form class="col-md-12 p-t-10" role="form" method="POST"
                          action="{{ route('backpack.auth.register') }}">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label class="control-label" for="name">Họ và tên</label>

                            <div>
                                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                       name="name" id="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label"
                                   for="{{ backpack_authentication_column() }}">{{ config('backpack.base.authentication_column_name') }}</label>

                            <div>
                                <input type="{{ backpack_authentication_column()=='email'?'email':'text'}}"
                                       class="form-control{{ $errors->has(backpack_authentication_column()) ? ' is-invalid' : '' }}"
                                       name="{{ backpack_authentication_column() }}"
                                       id="{{ backpack_authentication_column() }}"
                                       value="{{ old(backpack_authentication_column()) }}">

                                @if ($errors->has(backpack_authentication_column()))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first(backpack_authentication_column()) }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="password">Mật khẩu</label>

                            <div>
                                <input type="password"
                                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       name="password" id="password">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label"
                                   for="password_confirmation">Xác nhận lại mật khẩu</label>

                            <div>
                                <input type="password"
                                       class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                       name="password_confirmation" id="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label"
                                   for="id_card">Số căn cước công dân</label>

                            <div>
                                <input type="text"
                                       class="form-control"
                                       name="id_card" id="id_card">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label"
                                   for="id_card">Số điện thoại</label>

                            <div>
                                <input type="text"
                                       class="form-control"
                                       name="phone" id="phone">
                            </div>
                        </div>'

                        <div class="form-group">
                            <div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"
                                               name="remember"> Tôi đồng ý với <a href="#" data-toggle="modal" data-target="#rule" class="text-info">Điều khoản dịch vụ</a>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-block btn-info">
                                    Đăng ký
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @if (backpack_users_have_email() && config('backpack.base.setup_password_recovery_routes', true))
                <div class="text-center">
                    <a href="{{ route('backpack.auth.password.reset') }}">Quên mật khẩu</a>
                </div>
            @endif
            <div class="text-center"><a
                    href="{{ route('backpack.auth.login') }}">Đăng nhập</a></div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="rule" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Điều khoản dịch vụ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Nội dung của các điều khoản này
                    Dù biết rằng bạn rất dễ bỏ qua những Điều khoản dịch vụ này, nhưng chúng tôi cần phải nêu rõ trách nhiệm của chúng tôi cũng như trách nhiệm của bạn trong quá trình bạn sử dụng các dịch vụ của Google.
                    Các Điều khoản dịch vụ này phản ánh cách thức kinh doanh của Google, những điều luật mà công ty chúng tôi phải tuân theo và một số điều mà chúng tôi vẫn luôn tin là đúng. Do đó, các Điều khoản dịch vụ này giúp xác định mối quan hệ giữa Google với bạn khi bạn tương tác với các dịch vụ của chúng tôi. Ví dụ: Các điều khoản này trình bày các chủ đề sau:

                    Trách nhiệm của chúng tôi: Đây là phần mô tả cách chúng tôi cung cấp và phát triển các dịch vụ của mình
                    Trách nhiệm của bạn: Phần này nêu ra một số quy tắc mà bạn phải tuân theo khi sử dụng các dịch vụ của chúng tôi
                    Nội dung trong các dịch vụ của Google: Phần này mô tả quyền sở hữu trí tuệ đối với nội dung mà bạn thấy trong các dịch vụ của chúng tôi, bất kể nội dung đó thuộc về bạn, Google hay người khác
                    Trong trường hợp xảy ra vấn đề hoặc bất đồng: Phần này mô tả các quyền hợp pháp khác mà bạn có và những điều bạn nên biết trong trường hợp có người vi phạm các điều khoản này
                    Việc hiểu rõ các điều khoản này là rất quan trọng vì bằng việc sử dụng các dịch vụ của chúng tôi, bạn đồng ý với các điều khoản này.

                    Bên cạnh các điều khoản này, chúng tôi cũng ban hành Chính sách quyền riêng tư. Mặc dù không nằm trong các điều khoản này, nhưng đây là một chính sách bạn nên đọc để hiểu rõ hơn cách bạn có thể cập nhật, quản lý, xuất và xóa thông tin của mình.

                    Nhà cung cấp dịch vụ
                    Pháp nhân sau đây cung cấp các dịch vụ của Google và ký kết hợp đồng với bạn:

                    Google LLC
                    được thành lập theo luật của tiểu bang Delaware, Hoa Kỳ và hoạt động theo luật pháp Hoa Kỳ

                    1600 Amphitheatre Parkway
                    Mountain View, California 94043
                    Hoa Kỳ

                    Yêu cầu về độ tuổi
                    Nếu chưa đủ tuổi để tự quản lý Tài khoản Google theo quy định, bạn phải được cha mẹ hoặc người giám hộ hợp pháp cho phép thì mới có thể sử dụng Tài khoản Google. Vui lòng yêu cầu cha mẹ hoặc người giám hộ hợp pháp cùng bạn đọc các điều khoản này.

                    Nếu bạn là cha mẹ hoặc người giám hộ hợp pháp và bạn cho phép con bạn sử dụng các dịch vụ này, thì bạn phải tuân theo các điều khoản này và chịu trách nhiệm đối với hoạt động của con bạn trong các dịch vụ đó.

                    Một số dịch vụ của Google có các yêu cầu bổ sung về độ tuổi như mô tả trong các chính sách và điều khoản bổ sung dành riêng cho từng dịch vụ.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>

                </div>
            </div>
        </div>
    </div>
@endsection
