<div class="navbar-top">
    <div class=" container-ssm">


    <!-- <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav> -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light nav-custom">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('home')}}">@lang('messages.home')</a>
                    </li>
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link" href="#">Siêu dữ liệu</a>
                        <ul class="second-level-menu">
                            <li><a href="#">Lớp dữ liệu tọa độ, độ cao</a></li>
                            <li>
                                <a href="#">Lớp dữ liệu tài nguyên nước</a>
                                <ul class="third-level-menu">
                                    <li><a href="#">Hiện trạng khai thác nước dưới đất</a></li>
                                    <li><a href="#">Quy hoạch khai thác, bảo vệ nước dưới đất</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Lớp dữ liệu đất đai</a>
                                <ul class="third-level-menu">
                                    <li ><a href="">Lĩnh vực liên quan đất đai khác</a></li>
                                    <li ><a href="">Hiện trạng sử dụng đất tỉnh</a></li>
                                    <li ><a href="">Quy hoạch sử dụng đất tỉnh</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Lớp dữ liệu môi trường</a>
                                <ul class="third-level-menu">
                                     <li ><a href="">Quan trắc</a></li>
                                     <li ><a href="">Quy hoạch bảo vệ môi trường</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Lớp dữ liệu nền địa hình</a>
                                <ul class="third-level-menu">
                                    <li ><a href="">Thủy Hệ</a></li>
                                    <li ><a href="">Hành chính</a></li>
                                    <li ><a href="">Giao thông</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>  -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#">Bản đồ chuyên đề</a>
                        <ul class="second-level-menu">
                            
                            @foreach($categoriesload as $category)
                                <li>
                                    <a href="{{route('categoryMap.client',$category->id)}}">{{$category->name}}</a>
                                    @if(count($category->children)>0)
                                        <ul class="third-level-menu">
                                              @foreach($category->children as $children)
                                                <li class="nav-link"><a href="{{route('categoryMap.client',$children->id)}}">{{$children->name}}</a></li>     
                                              @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                         
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{route('introduce.client')}}">@lang('messages.gioithieu')</a>
                    </li>   
                    <li class="nav-item">
                        <a class="nav-link " href="{{route('contact.client')}}">Phản hồi</a>
                    </li>
                </ul>
                <div class="form-inline my-2 my-lg-0 navbar-login">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item">
                            @if(!$afteruserlogin)
                                <a class="nav-link " href="{{route('login')}}"> <i class="fa-solid fa-lock"></i> Đăng nhập</a>
                            @else
                                <a class="nav-link " href="{{route('login')}}"> <i class="far fa-user-circle"></i> {{ $afteruserlogin->name}}</a>
                                <ul class="second-level-menu" style="max-width:300px">
                                    <li class="nav-link"><a href="{{route('view.pass.client')}}">Thay đổi mật khẩu</a></li>
                                    <li class="nav-link"><a href="{{route('view.account.client')}}">Thông tin tài khoản</a></li>
                                    <li class="nav-link"><a href="{{route('logout')}}">Đăng xuất</a></li>
                                </ul>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
</div>
        </nav>
    </div>

    <!-- <nav class="navbar-expand-lg navbar-light nav-top container-ssm">
        <div class="collapse navbar-collapse "  id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0" >
                <li class="nav-item active">
                    <a class="nav-link-top nav-link {{ request()->is('/')? 'active':''}}" href="/" ><i class="fa fa-home"></i>  Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-top nav-link " href="about">Siêu dữ liệu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-top nav-link" href="">Bản đồ chuyên đề</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-top nav-link" href="#">Tài liệu về TN&MT</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-top nav-link" href="#">Tin tức</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-top nav-link" href="#">Giới thiệu</a>
                </li>
            </ul>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link-top nav-link" aria-current="page" href="">Đăng nhập</a>
                    </li>
                </ul>		  
            </div>     
        </div>
    <nav> -->
</div>
<script>
    $(document).ready(function() {
  $('.navbar a.dropdown-toggle').on('click', function(e) {
    console.log("hello world");
     var $el = $(this);
     var $parent = $(this).offsetParent(".dropdown-menu");
     $(this).parent("li").toggleClass('open');
     if(!$parent.parent().hasClass('nav')) {
          $el.next().css({"top": $el[0].offsetTop, "left": $parent.outerWidth() - 4});
     }
     $('.nav li.open').not($(this).parents("li")).removeClass("open");
     return false;
    });
});
</script>