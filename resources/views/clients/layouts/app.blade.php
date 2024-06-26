
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống thu thập cơ sở dữ liệu</title>
    <link href="{{asset('assets/vendor/bootstrap-5.3.3/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- <script type="text/javascript" src="{{ asset('assets/clients/javascript.js') }}"></script> -->
    <!-- <script type="text/javascript" src="{{ asset('assets/clients/nprogress.js') }}"></script> -->
    <link rel="stylesheet" href="{{ asset('assets/clients/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/nprogress/nprogress.css') }}" />
    <!-- <link rel="stylesheet" href="{{ asset('assets/clients/responsive.css') }}" /> -->
    <link rel="stylesheet" href="{{asset('assets/vendor/icon_font-awesome/css/fontawesome.min.css')}}">
    <link href="{{asset('assets/vendor/icon_font-awesome/css/brands.min.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/vendor/icon_font-awesome/css/solid.min.css')}}" rel="stylesheet" />
    <script src="{{asset('assets/vendor/bootstrap-5.3.3/dist/js/bootstrap4.5.bundle.js')}}" ></script>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <video class="video-bg" loading="lazy" autoplay muted loop poster="https://nhadepso.com/wp-content/uploads/2023/03/hinh-nen-cong-nghe_1.jpg">
        <source src="{{asset('assets/video/video-bg03.mp4')}}" type="video/mp4">
    </video>
    <div class="wrapper">
        <div id="loading-line"></div>
        <!-- start - header -->
        @include("clients.layouts.header")
        <!-- end - header -->
        <!-- start - navigation -->
        @include("clients.layouts.navbar")  
        <!-- end - navigation -->
        <!-- start - body -->
        <div class="container-xl mt-3 container-ssm containero" >
            <div class="row">
                <!-- start - left nav body -->
        
                <!-- end - left nav body -->
                <!-- start - content -->
                @yield("content")
                <!-- start - content -->
            </div>
        </div>
        <!-- end - body -->
        @include("clients.layouts.footer")
    </div>
</body>
<!-- start footer -->
    <script src="{{ asset('assets/vendor/nprogress/nprogress.js')}}"></script>
    <script src="{{ asset('assets/clients/js/clients.js')}}"></script>
<!-- end footer -->
</html>