<div class="header navbar">
    <div class="header-container">
        <div class="row">
            <div class="col-4">
                <ul class="nav-left navbar-dark">
                    <li>
                        <a class="side-nav-toggle" href="javascript:void(0);">
                            <i class="fa-solid fa-grip font-size-20"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-4 text-homepgae">
                <h3>Hệ thống quản trị</h3>
            </div>
            <div class="col-4">
                <ul class="nav-right">
                    <li>
                        <a href="{{route('home')}}">
                            <button class="btn btn-primary"> <i class="fa-solid fa-house"></i> Xem Trang chủ </button>
                        </a>      
                    </li>
                    <li class="user-profile dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                             <i class="fa-solid fa-user"></i>
                            <!-- <img class="profile-img img-fluid" src="../../assets/images/logo/user.png" alt=""> -->
                            <div class="user-info">
                                <span class="name pdd-right-5">
                                    <?php
                                        // $message=Session::get('name');
                                        // if($message){
                                        //     echo  $message;
                                        //     //Session::put('message',null);
                                        // }    
                                      ?>
                                </span>
                                <i class="fa-solid fa-angle-down"></i>
                            </div>
                        </a>
                        <ul class="dropdown-menu" style="margin-top: -5px; margin-right: 15px;">
                            <!-- <li>
                                <a href="#">
                                    <i class="fa-solid fa-gear"></i>
                                    <span>Cài đặt</span>
                                </a>
                            </li> -->
                            <li>
                                <a href="{{route('view.account.admin')}}">
                                     <i class="fa-solid fa-ellipsis-vertical"></i>
                                    <span>Quản trị</span>
                                </a>
                            </li>
                                <li>
                                <a href="{{route('view.pass.admin')}}">
                                <i class="fa-solid fa-key"></i>
                                    <span>Đổi mật khẩu</span>
                                </a>
                            </li> 
                            <!-- <li role="separator" class="divider"></li> -->
                            <li>
                                <a href="{{route('logout')}}">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                    <span>Đăng xuất</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>