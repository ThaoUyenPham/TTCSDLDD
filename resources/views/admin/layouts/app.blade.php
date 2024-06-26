<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
    <title>Quản lý điểm lấy mẫu</title>
    <!-- Favicon -->
 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{asset('assets/admin/js/jquery.min.js')}}"></script>
    <!-- Plugins CSS -->
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{URL::asset('assets/admin/css/bootstraps.css')}}">
    <!-- Page Plugins CSS -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/datepicker3.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/nprogress/nprogress.css')}}" />
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/5.0.0/css/fixedColumns.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/2.0.1/css/select.dataTables.css"> -->
    <script src="{{asset('assets/vendor/ckeditor/ckeditor.js')}}"></script>
    <!-- Core CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/icon_font-awesome/css/fontawesome.min.css')}}">
    <link href="{{asset('assets/vendor/icon_font-awesome/css/brands.min.css')}}" rel="stylesheet" />
     <link href="{{asset('assets/vendor/icon_font-awesome/css/solid.min.css')}}" rel="stylesheet" />
     <link href="{{asset('assets/admin/css/style.css')}}" rel="stylesheet" />
    <!-- <script src="{{asset('assets/vendor/bootstrap-5.3.3/dist/js/bootstrap4.5.bundle.js')}}" ></script> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="{{asset('assets/admin/css/app.css')}}" rel="stylesheet">
</head>
<body>
    <!-- <div id="loading-line"></div> -->
    <div class="app">
        <div class="layout">
            <!-- Side Nav START -->
            <div class="side-nav">
                 @include("admin.layouts.navbar")
            </div>
            <!-- Side Nav END -->

            <!-- Page Container START -->
            <div class="page-container">
                <!-- Header START -->
                @include("admin.layouts.header")
                <!-- Header END -->
                <!-- Modal START -->
                <!-- Modal About Us -->
                <div class="modal fade" id="aboutUs">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 style="text-transform: uppercase; color: #0f9aee">
                                    <i class="icon-profile" style="font-size: 16px; margin-top: -2px"></i>
                                    <b>Giới thiệu về hệ thống quản trị tài nguyên nước Tiền Giang</b>
                                </h4>
                            </div>
                            <div class="modal-body">
                                <div class="tab-info">
                                    <ul class="nav nav-tabs" role="tablist" id="aboutTabs">
                                        <li class="nav-item">
                                            <a href="#about" class="nav-link active" role="tab" data-toggle="tab">
                                                <i class="icon-profile pdd-right-10"></i> Giới thiệu dự án
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#contact" class="nav-link" role="tab" data-toggle="tab">
                                                <i class="fa fa-envelope pdd-right-10"></i> Liên hệ chúng tôi
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#developers" class="nav-link" role="tab" data-toggle="tab">
                                                <i class="fa fa-exclamation-circle pdd-right-10"></i> Đơn vị phát triển phần mềm
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="aboutTabsContent">
                                        <div role="tabpanel" class="tab-pane fade in active" id="about">
                                            <div class="pdd-horizon-15 pdd-vertical-20">
                                                <p>Hệ thống truyền, nhận, quản lý và công bố dữ liệu các hệ thống quản trị tài nguyên nước của tỉnh Tiền Giang tích hợp số liệu quan trắc các nguồn thải từ các khu công nghiệp, khu chế xuất và khu công nghệ
                                                    cao nói riêng và quan trắc nguồn điểm nói chung nhằm mục đích bảo vệ nguồn tiếp nhận (sông, hồ), đảm bảo chất lượng nước thải của các khu công nghiệp, khu chế xuất, khu công nghệ cao trước khi thải vào
                                                    nguồn tiếp nhận;</p>
                                                <div class="panel panel-primary">
                                                    <div class="panel-heading" style="text-hozAlign: center">
                                                        <b>CÁC NGUỒN TIẾP NHẬN</b>
                                                    </div>
                                                    <ul class="list-group">
                                                    <li class="list-group-item">Các trạm quan trắc tự động</li>
                                                    <li class="list-group-item">Các trạm quan trắc bán tự động</li>
                                                    <li class="list-group-item">Các doanh nghiệp xả thải trên 1000 m³
                                                    </li>
                                                </ul>
                                                <a href="../../HDSD_QuanTracTienGiang.docx">Hướng dẫn sử dụng</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="contact">
                                            <div class="pdd-top-5">
                                                <form class="contact-form">
                                                    <div class="well well-sm">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="first-name">Họ và tên</label>
                                                                    <input class="form-control" style="border: 1px solid #888da8" id="first-name" type="text">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="last-name">Địa chỉ Email</label>
                                                                    <input class="form-control" style="border: 1px solid #888da8" id="last-name" type="text">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="message">Tin nhắn:</label>
                                                                    <textarea class="form-control" style="border: 1px solid #888da8" id="message" rows="3"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 hozAlign-self-center">
                                                                <div class="form-group">
                                                                    <button class="btn btn-info pull-right" data-dismiss="modal" type="submit">Gửi đến chúng
                                                                        tôi
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="developers">
                                            <div class="pdd-horizon-15 pdd-vertical-20">
                                                <p style="text-transform: uppercase">Trung tâm ứng dụng công nghệ thông tin phía Nam</p>
                                                <p>
                                                    <i class="icon-location4 blue" style="font-size: 16px; margin-top: -2px"></i>
                                                    <a href="https://www.google.com/maps/place/Số 36, Lý Văn Phức, Tân Định, Quận 1, Thành phố Hồ Chí Minh" target="_blank">
                                                        Số 36, Lý Văn Phức, P.Tân Định, Q.1, TP.HCM
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-info" data-dismiss="modal" type="button">Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                    <!-- Thông tin điểm KTSD NDD -->
                    @yield("content")
                </div>  
            </div>
            <!-- Content Wrapper END -->
        </div>
        <!-- Page Container END -->
    </div>
    <script src="https://dlm.ttcntnmt.com.vn/assets/js/vendor.js"></script>
    <!-- Page Plugins JS -->
    <script src="{{asset('assets/vendor/nprogress/nprogress.js')}}"></script>
    <script src="{{asset('assets/admin/js/daterangepicker.js')}}"></script>
    <script src="{{asset('assets/admin/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('assets/admin/js/bootstrap-timepicker.js')}}"></script>
    <!-- Main JS Custom -->
    <script src="{{asset('assets/admin/js/app.js')}}"></script>
    <script src="https://dlm.ttcntnmt.com.vn/assets/js/forms/form-elements.js"></script>
    <script>
        $('.dropdown-menu').on('click', function(e) {
            e.stopPropagation();
        });
    </script>
    <!-- Thông tin điểm KTSD NDD -->
</body>
    <!-- <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script> -->
    <!-- <link rel="stylesheet" type="text/css" href=" https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"/> -->
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->
    <!-- <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script> -->
    <!-- <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script> -->
</html>
