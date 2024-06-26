@extends("admin.layouts.app")

@section("content")

<div class="main-content">
    <div class="card">
        <div class="card-block pdd-vertical-15 pdd-horizon-15">
            <h4 class="card-title text-bold text-info">
               Chi tiết người dùng
            </h4>
            <div class="row">
                <div class="col-md-12">
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
                                <input class="form-control input-sm" value="{{$inforUsers->name}}" id="name" placeholder="Nhâp người dùng/tổ chức" type="text">
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
                                <input class="form-control input-sm" value="{{$inforUsers->email}}" id="email" placeholder="Nhâp Email người dùng/tổ chức" type="email">
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
                                <input class="form-control input-sm" value="{{$inforUsers->company}}" id="company" placeholder="Nhâp tên cơ quan/ công ty" type="text">
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
                                <input class="form-control input-sm" value="" id="is_block" placeholder="Khóa" type="checkbox" {{ $inforUsers->is_block ? 'checked' : '' }}>
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
                                <input type="number" name="" value="{{$inforUsers->number}}" class="form-control input-sm" id="phone" placeholder="Số điện thoại">
                            </div> 
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-4 control-label">
                                <b>Tên tài khoản đăng nhập</b>
                            </label>
                            <div class="col-md-8">
                                <span class="form-control input-sm" >{{$inforUsers->username}}</span>
                                <!-- <input type="text" name="" class="form-control input-sm" id="username" placeholder="Tên tài khoản đăng nhập"> -->
                            </div> 
                        </div>
                    </form>
                </div>
                <div class="col-md-6 showpassword" style="display:none" >
                    <form class="form-horizontal  pdd-right-30">
                        <div class="form-group row list-ctkt">
                            <label style="margin-top: 7px" class="col-md-4 control-label">
                                <b>Mật khẩu reset</b>
                            </label>
                            <div class="col-md-8">
                                <input type="text" name="" class="form-control input-sm" id="password" placeholder="mật Khẩu">
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
                                @foreach($permissionUsers as $permissionUser)
                                    <tr>
                                        <td>
                                            <input class="form-control input-sm" type="hidden" disabled value="{{ $permissionUser->id }}">
                                            <input class="form-control input-sm" type="text" disabled value="{{ $permissionUser->namesecurity }}">
                                        </td>
                                        
                                        <td>
                                            <a class="btn btn-danger btn-sm deleteInput text-white">Delete</a>
                                        </td>
                                    </tr>
                                    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="list-ctkt text-right">
                        <a href="#" class="btn btn-info btn-sm" id="updateUsers">
                            <i class="ti-plus pdd-right-5"></i>
                            <span>Cập nhật</span>
                        </a>
                        <a href="#" class="btn btn-danger btn-sm" id="deleteUsers">
                            <i class="ti-plus pdd-right-5"></i>
                            <span>Xóa</span>
                        </a>
                        <a href="#" class="btn btn-danger btn-sm" id="ResetUsers">
                            <i class="ti-plus pdd-right-5"></i>
                            <span>ResetPassWord</span>
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
                let datainput= `<td><span>`+permission.text()+`</span><input type="hidden" value=""> <input type="hidden" value="`+permission.val()+`"></td>`;
                let actionCell = $('<td>');
                actionCell.append($('<a class="btn btn-danger btn-sm deleteInput text-white">Delete</a>'));
                row.append(datainput);
                 row.append(actionCell);
                $("#inputList").append(row);
        }else {
            console.log("No rows deleted")
        }
    });
    function isEmptyOrWhitespace(str) {
            return str.trim().length === 0;
        }
    $(document).on("click", ".deleteInput", function () {
        if(confirm("Bạn có chắc muốn xóa không"))
        {
            let remove=$(this).closest("tr");
            let id=$(this).closest("tr").find('td input')[0].value;
            console.log(id);
            if(!isEmptyOrWhitespace(id))
            {
                $.ajax({
                    type:'PUT',
                    url:"{{route('delete.listpermission')}}",
                    data:{id:id},
                    headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') // Include CSRF token in headers
                            },
                    success:function(data){
                        if(data.success==1)
                        {
                            Swal.fire(
                                'Thông báo',
                                'Đã xóa thành công',
                                'success' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                            ).then((result) => {
                                if (result.isConfirmed) {
                                    // Run your function here
                                    // remove.remove();
                                }
                            }); 
                            remove.remove();    
                        }
                    },
                    error: function(data){
                        Swal.fire(
                            'Thông báo',
                            'Đã có lỗi xảy ra vui lòng liên hệ với nhà phát triển!',
                            'error' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                        ); 
                        console.log(data.responseText);
                    }
                });
            }else{
                Swal.fire(
                    'Thông báo',
                    'Đã xóa thành công',
                    'success' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                );
                // console.log(remove);
                remove.remove();
            }   
        }
    });
    $("#deleteUsers").click(function(){
        let categoryID = "{{ $inforUsers->id }}";
        let editUrl = '{{ route("delete.users", ":id") }}';
            editUrl = editUrl.replace(':id', categoryID);
        if(confirm('bạn có chắc muốn xóa thông báo này!'))
        {
            $.ajax({
                type: 'PUT',
                url: editUrl,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') // Include CSRF token in headers
                },
                success: function(response) {
                    if(response.success==1)
                    {   
                        Swal.fire(
                            'Thông báo',
                            'Đã xóa thành công',
                            'success' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                        ).then((result) => {
                            if (result.isConfirmed) {
                                // Run your function here
                                window.location.href ='{{route("index.users")}}';
                            }
                        }); 
                        // $("#showpassword").css("display","block");
                        // $("#password").val(response.success.password);
                        // window.location.href ='{{route("index.users")}}';
                    }else{
                        Swal.fire(
                            'Thông báo',
                            'Đã có lỗi xảy ra vui lòng liên hệ với nhà phát triển!',
                            'error' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                        ); 
                        console.log(response);
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
        }
    });
    $("#ResetUsers").click(function(){
        let categoryID = "{{ $inforUsers->id }}";
        let editUrl = '{{ route("reset.users", ":id") }}';
            editUrl = editUrl.replace(':id', categoryID);
        if(confirm('bạn có chắc muốn thay đổi password!'))
        {
            $.ajax({
                type: 'PUT',
                url: editUrl,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') // Include CSRF token in headers
                },
                success: function(response) {
                    if(response.success==1)
                    {
                        Swal.fire(
                            'Thông báo',
                            'Reset mật khẩu thành công!, Vui long coppy mật khẩu sau thông báo này',
                            'success' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                        );
                        $(".showpassword").css("display","block");
                        $("#password").val(response.password)
                        // window.location.href ='{{route("index.users")}}';
                    }else{
                      
                        Swal.fire(
                            'Thông báo',
                            'Đã có lỗi xảy ra vui lòng liên hệ với nhà phát triển!',
                            'error' // các loại khác có thể là 'error', 'warning', 'info', 'question'
                        ); 
                        console.log(response);
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
        }
    });
    $('#updateUsers').click(function(){
        let thead=$('#talbe_permission tr').map(function(){
            return [$(this).find('td input, td select').map(function(){
                return $(this)
            }).get()]
        }).get();
        let permission=[];
        for (let i = 1; i < thead.length; i++) {
            permission[i-1]=[];
            for (let j = 0; j < 2; j++) {
                try {
                    permission[i-1][j] = thead[i][j][0].value;
                } catch (error) {
                    console.log(error);
                }
            }
        }
        let name=$('#name').val();
        let company=$('#company').val();
        let is_block=$('#is_block').is(":checked");
        let phone=$('#phone').val();   
        let email=$('#email').val();   
        let userId = "{{ $inforUsers->id }}";
        let editUrl = '{{ route("update.users", ":id") }}';
            editUrl = editUrl.replace(':id', userId);
        if(confirm("Bạn có muốn cập nhật "))
        {
            $.ajax({
                type: 'PUT',
                url: editUrl,
                data: {
                    name:name,
                    is_block:is_block,
                    phone:phone,
                    email:email,
                    company:company,
                    permission:permission
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') // Include CSRF token in headers
                },
                success: function(response) {
                    // console.log(response);
                    if(response.success=1)
                    {
                        alert('Thêm thành công!');
                        location.reload();
                        // window.location.href = backUrl;
                    }else {
                        alert("đã có lỗi vui lòng kiểm tra lại");
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    console.error('Status: ' + status);
                    console.error('Error: ' + error);
                }
            });  
        }
    })
</script>
<!-- <script src="{{asset('assets/admin/setcategory/create.js')}}"> -->

</script>
@endsection("content")