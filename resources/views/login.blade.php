<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
    <title>Quản lý điểm lấy mẫu</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/SoTNMT.ico">
    <!-- plugins css -->
    <link rel="stylesheet" href="https://dlm.ttcntnmt.com.vn/vendors/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- core css -->
    <link href="https://dlm.ttcntnmt.com.vn/assets/css/app.css" rel="stylesheet">
</head>
<body>
    <div class="app">
        <div class="authentication">
            <div class="sign-in-2">
                <div class="container-fluid no-pdd-horizon bg" style="background-image: url(https://dlm.ttcntnmt.com.vn/assets/images/backgounds/rfcode-hero-background.jpg)">
                    <div class="row">
                        <div class="col-md-10 mr-auto ml-auto">
                            <div class="row">
                                <div class="mr-auto ml-auto full-height height-100 d-flex align-items-center">
                                    <div class="vertical-align full-height">
                                        <div class="table-cell">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="pdd-horizon-30 pdd-vertical-30">
                                                        <div class="mrg-btm-30">
                                                            <img class="img-responsive" src="https://dlm.ttcntnmt.com.vn/assets/images/monre_logo.png"
                                                                 style="display: block; margin-left: auto; margin-right: auto;">
                                                            <h2 class="no-mrg-vertical text-bold text-center">SỞ TÀI NGUYÊN MÔI TRƯỜNG TỈNH TIỀN GIANG</h2>
                                                            <h2 class="no-mrg-vertical text-bold text-center">TRUNG TÂM CÔNG NGHỆ THÔNG TIN</h2>
                                                            <h2 class="no-mrg-vertical text-bold text-info text-center">HỆ THỐNG THU THẬP CƠ SỞ DỮ LIỆU MÔI TRƯỜNG</h2>
                                                        </div>
                                                        <h5 class="no-mrg-vertical text-bold text-center mrg-btm-5">ĐĂNG NHẬP HỆ THỐNG</h5>
                                                        <form method="post" action="{{route('signAccount')}}">
                                                            {{ csrf_field()}}
                                                            <div class="form-group">
                                                                <input type="text" name="username" class="form-control " placeholder="Tài khoản">
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="password" name="password" class="form-control" placeholder="Mật khẩu">
                                                            </div>
                                                            <div class="form-group">
                                                                {{-- $message=Session::get('message');
                                                                if($message){
                                                                    echo "sai tai khoan mat khau vui long nhap lai";
                                                                    Session::put('message',null);
                                                                }     --}}
                                                                @if(session('error'))
                                                                    <div class="alert alert-danger">
                                                                        {{ session('error') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="mrg-top-20 text-right">
                                                                <button type="submit" name="btn_submit" class="btn btn-info">Đăng nhập</button>
                                                            </div>
                                                            <div class="no-mrg-vertical text-dark text-bold">
                                                                <a href="{{route('home')}}" >Quay Lại Trang Chủ</a>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://dlm.ttcntnmt.com.vn/assets/js/vendor.js"></script>
</body>
<footer>
    
</footer>
</html>
