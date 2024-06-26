@extends("admin.layouts.app")

@section("content")

<div class="main-content">
    <div class="card">
        <div class="card-block pdd-vertical-15 pdd-horizon-15">
            <h4 class="card-title text-bold text-info">
                Thêm người dùng mới
            </h4>
            <div class="row">
                <div class="col-md-12">
                    <!-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif -->
                </div>
            </div>
            <div class="row"> <!-- khung tìm kiếm -->
                <div class="col-md-6">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Tên Người dùng/Tổ chức</b>
                            </label>
                            <div class="col-md-9">
                                <input class="form-control input-sm" value="" id="name" placeholder="Nhâp người dùng/tổ chức" type="text">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <form class="form-horizontal pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Email của người dùng/tổ chức</b>
                            </label>
                            <div class="col-md-9">
                                <input class="form-control input-sm" value="" id="email" placeholder="Nhâp Email người dùng/tổ chức" type="email">
                            </div> 
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <form class="form-horizontal pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Tên cơ quan/công ty</b>
                            </label>
                            <div class="col-md-9">
                                <input class="form-control input-sm" value="" id="company" placeholder="Nhâp tên cơ quan/ công ty" type="text">
                            </div> 
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Khóa</b>
                            </label>
                            <div class="col-md-9">
                                <input class="form-control input-sm" value="" id="is_block" placeholder="Khóa" type="checkbox">
                            </div> 
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Số điện thoại</b>
                            </label>
                            <div class="col-md-9">
                                <input type="number" name="" class="form-control input-sm" id="phone" placeholder="Số điện thoại">
                            </div> 
                        </div>
                    </form>
                </div>
                <div class="col-md-7">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-4 control-label">
                                <b>Tên tài khoản đăng nhập</b>
                            </label>
                            <div class="col-md-8">
                                <input type="text" name="" class="form-control input-sm" id="username" placeholder="Tên tài khoản đăng nhập">
                            </div> 
                        </div>
                    </form>
                </div>
                <div class="col-md-7">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-4 control-label">
                                <b>Mật khẩu Đăng nhập</b>
                            </label>
                            <div class="col-md-8">
                                <input type="password" name="" class="form-control input-sm" id="password" placeholder="Nhập mật khẩu đăng nhập">
                            </div> 
                        </div>
                    </form>
                </div>
                <div class="col-md-7">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-4 control-label">
                                <b>Nhập lại mật khẩu đăng nhập </b>
                            </label>
                            <div class="col-md-8">
                                <input type="password" name="" class="form-control input-sm" id="confinpassword" placeholder="nhập lai mật khẩu đăng nhập">
                            </div> 
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h2>Quyền người dùng</h2>
                    <div class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-3 control-label">
                                <b>Thiết lập quyền cho người dùng</b>
                            </label>
                            <div class="col-md-6">
                                <select class="form-control input-sm" name="" id="getPermission">
                                    <option value="">-- Chọn quyền --</option>
                                    @foreach($permissions as $permission)
                                        <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <a class="btn btn-info btn-sm text-white" id="clickChoosePermission" >
                                    <i class="ti-plus pdd-right-5"></i>
                                    <span>Chọn quyền</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="container mt-4">
                            <h1>Danh sách quyền</h1>
                        <table class="table mt-4" id="talbe_permission">
                            <thead>
                                <tr>
                                    <th scope="col">Tên quyền</th>
                                    <!-- <th scope="col">thời gian bắt đầu</th>
                                    <th scope="col">Thời hạn</th> -->
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="inputList">
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="list-ctkt text-right">
                        <a href="#" class="btn btn-info btn-sm" id="createUser">
                            <i class="ti-plus pdd-right-5"></i>
                            <span>Thêm mới</span>
                        </a>
                        <a href="{{route('index.users')}}" class="btn btn-primary btn-sm" id="">
                            <i class="ti-plus pdd-right-5"></i>
                            <span>Quay về</span>
                        </a>
                    </div>
                 </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("#clickChoosePermission").click(function(){
        let permission= $("#getPermission option:selected");
        if (confirm("Bạn chắc chắn muốn thêm?")) {
                let row = $("<tr>");
                let datainput= `<td><span>`+permission.text()+`</span> <input type="hidden" value="`+permission.val()+`"></td>`;
                let actionCell = $('<td>');
                actionCell.append($('<a class="btn btn-danger btn-sm deleteInput text-white">Delete</a>'));
                row.append(datainput);
                 row.append(actionCell);
                $("#inputList").append(row);
        }else {
            console.log("No rows deleted")
        }
    });
    $(document).on("click", ".deleteInput", function () {
            $(this).closest("tr").remove();
        });

        // Move input up
    $('#createUser').click(function(){
        let thead=$('#talbe_permission tr').map(function(){
            return [$(this).find('td input, td select').map(function(){
                return $(this)
            }).get()]
        }).get();
        let permission=[];
       
        for (let i = 1; i < thead.length; i++) {
            permission[i-1]=[];
            for (let j = 0; j < 1; j++) {
                try {
                    permission[i-1][j] = thead[i][j][0].value;
                } catch (error) {
                    console.log(error);
                }
            }
        }
        // console.log(permission);
        let name=$('#name').val();
        let company=$('#company').val();
        let is_block=$('#is_block').is(":checked");
        let phone=$('#phone').val();
        let username=$('#username').val();    
        let email=$('#email').val();   
        let password=$('#password').val();   
        let confinpassword=$('#confinpassword').val();      
        if(confirm("bạn có chắc muốn thêm người dùng mới"))
        {
            if(name==""||username==""||email==""||permission.length==0){
                Swal.fire(
                    'Thông báo',
                    'Cảnh báo có mục không được để trống',
                    'warning' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                );
            }else{ 
                if(confinpassword==password)
                {
                    $.ajax({
                        type: 'POST',
                        url: '{{route("save.users")}}',
                        data: {
                            name:name,
                            is_block:is_block,
                            phone:phone,
                            username:username,
                            email:email,
                            password:password,
                            company:company,
                            permission:permission
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') // Include CSRF token in headers
                        },
                        success: function(response) {
                            console.log(response);
                            if(response.success=1)
                            {
                                Swal.fire(
                                    'Thông báo',
                                    'Thêm người dùng mới thành công',
                                    'success' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                                ).then((result) => {
                                    if (result.isConfirmed) {
                                        // Run your function here
                                        window.location.href = "{{URL::route('index.users')}}";
                                    }
                                });     
                            }else {
                                Swal.fire(
                                    'Thông báo',
                                    'Đã có lỗi xảy ra vui lòng liên hệ với nhà phát triển!',
                                    'error' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                                ); 
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire(
                                'Thông báo',
                                'Đã có lỗi xảy ra vui lòng liên hệ với nhà phát triển!',
                                'error' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                            ); 
                            console.error(xhr.responseText);
                            console.error('Status: ' + status);
                            console.error('Error: ' + error);
                        }
                    });
                }else{
                    Swal.fire(
                        'Thông báo',
                        'Vui lòng kiểm tra lại mật khẩu',
                        'error' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                    ); 
                }
            }
        }
    })
    $("#username").focus(function(){
        let usernamechange=$(this).val();
        $.ajax({
            type: 'POST',
            url: '{{route("check.users")}}',
            data: {
                username:usernamechange,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') // Include CSRF token in headers
            },
            success: function(response) {
                console.log(response);
                if(response.success==1)
                {
                    $('#createUser').css("display","none");
                }else{
                    $('#createUser').css("display","block");
                }
            },
            error: function(xhr, status, error) {
                Swal.fire(
                    'Thông báo',
                    'Đã có lỗi xảy ra vui lòng liên hệ với nhà phát triển!',
                    'error' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                ); 
                console.error(xhr.responseText);
                console.error('Status: ' + status);
                console.error('Error: ' + error);
            }
        });
    });
</script>
<!-- <script src="{{asset('assets/admin/setcategory/create.js')}}"> -->

</script>
@endsection("content")