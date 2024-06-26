<div class="side-nav-inner">
    <a href="/index.php">
        <div  class="side-nav-logo " style="height: 20  0px">               
            <img src= "https://dlm.ttcntnmt.com.vn/assets/images/monre_logo.png" class="cus_logo"/>
            <p class="text-white text-bold font-size-14 title_2" >
                HỆ THỐNG THU THẬP, QUẢN LÝ VÀ KHAI THÁC CSDL VỀ TN&MT 
            </p>
            <p class="text-white font-size-13 title_2">
                TIỀN GIANG
            </p>
            <div class="mobile-toggle side-nav-toggle">
                <a href="#">
                    <i class="ti-arrow-circle-left"></i>
                </a>
            </div>
        </div>
    </a>
    <ul class="side-nav-menu scrollable">
        <!-- <li class="nav-item" id="homepage">
            <a href="">
                <span class="icon-holder">
                    <i class="fa-solid fa-chevron-right"></i>
                </span>
                <span class="title">Siêu dữ liệu</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="">
                <span class="icon-holder">
                    <i class="fa-solid fa-chevron-right"></i>
                </span>
                <span class="title">Mẫu</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="">
                <span class="icon-holder">
                    <i class="fa-solid fa-chevron-right"></i>
                </span>
                <span class="title">Quản lý người dùng</span>
            </a>
        </li> -->
        <!-- <li class="nav-item">
            <a href="">
                <span class="icon-holder">
                    <i class="fa-solid fa-chevron-right"></i>
                </span>
                <span class="title">Quản lý nhóm</span>
            </a>
        </li> -->
        <li class="nav-item">
            <a href="{{ route('index.category')}}">
                <span class="icon-holder">
                    <i class="fa-solid fa-chevron-right"></i>
                </span>
                <span class="title">Quản lý danh mục</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('index.map')}}">
                <span class="icon-holder">
                    <i class="fa-solid fa-chevron-right"></i>
                </span>
                <span class="title">Quản lý bản đồ chuyên đề</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a href="{{route('index.contact')}}">
                <span class="icon-holder">
                    <i class="fa-solid fa-chevron-right"></i>
                </span>
                <span class="title">Quản lý Liên hệ</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('index.systemgeo')}}">
                <span class="icon-holder">
                    <i class="fa-solid fa-chevron-right"></i>
                </span>
                <span class="title">Quản lý máy chủ geo</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('index.topads')}}">
                <span class="icon-holder">
                    <i class="fa-solid fa-chevron-right"></i>
                </span>
                <span class="title">Quản lý thông báo</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('index.nativesrs')}}">
                <span class="icon-holder">
                    <i class="fa-solid fa-chevron-right"></i>
                </span>
                <span class="title">Quản lý Native SRS</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('index.ads.admin')}}">
                <span class="icon-holder">
                    <i class="fa-solid fa-chevron-right"></i>
                </span>
                <span class="title">Quản lý Liên kết</span>
            </a>
        </li>
    @if(count($showMenu)>0)
        <li class="nav-item">
            <a href="{{route('index.users')}}">
                <span class="icon-holder">
                    <i class="fa-solid fa-chevron-right"></i>
                </span>
                <span class="title">Quản lý Người dùng</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('index.permission')}}">
                <span class="icon-holder">
                    <i class="fa-solid fa-chevron-right"></i>
                </span>
                <span class="title">Quản lý quyền</span>
            </a>
        </li>
    @endif
        <li class="nav-item">
            <a href="{{route('index.district.admin')}}">
                <span class="icon-holder">
                    <i class="fa-solid fa-chevron-right"></i>
                </span>
                <span class="title">Quản lý Huyện</span>
            </a>
        </li>
    </ul>
</div>